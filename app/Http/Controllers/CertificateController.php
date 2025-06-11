<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Models\CashAdvance;

class CertificateController extends Controller
{
    public function print($id)
    {
        $cashAdvance = CashAdvance::with('sdo')->findOrFail($id);
        $sdoName = $cashAdvance->sdo->name ?? 'N/A';

        $templatePath = storage_path('app/templates/certificate_template.docx');
        $docxDir = storage_path('app/public/certificates');
        $docxPath = "$docxDir/{$sdoName}_certificate_{$id}.docx";
        $pdfPath = "$docxDir/{$sdoName}_certificate_{$id}.pdf";

        // Ensure directory exists
        if (!file_exists($docxDir)) {
            mkdir($docxDir, 0775, true);
        }

        // Delete existing files if they exist
        if (file_exists($docxPath)) {
            unlink($docxPath);
        }
        if (file_exists($pdfPath)) {
            unlink($pdfPath);
        }

        // Generate DOCX from template
        try {
            $templateProcessor = new TemplateProcessor($templatePath);
            $templateProcessor->setValue('sdo_name', $sdoName);
            $templateProcessor->saveAs($docxPath);
        } catch (\Exception $e) {
            Log::error("DOCX generation failed: " . $e->getMessage());
            return response()->json(['error' => 'DOCX generation failed.'], 500);
        }

        // Check that the DOCX was created
        if (!file_exists($docxPath) || filesize($docxPath) === 0) {
            return response()->json(['error' => 'DOCX file is missing or empty.'], 500);
        }

        // Convert DOCX to PDF using LibreOffice
        $sofficePath = '"C:\Program Files\LibreOffice\program\soffice.exe"'; // update path if needed
        $cmd = "$sofficePath --headless --convert-to pdf \"$docxPath\" --outdir \"$docxDir\"";
        exec($cmd, $output, $resultCode);

        Log::info('LibreOffice convert output:', $output);

        // Verify PDF exists
        if (!file_exists($pdfPath)) {
            return response()->json(['error' => 'PDF conversion failed.'], 500);
        }

        // Serve the PDF inline
        return response()->file($pdfPath, [
            'Content-Type' => 'application/pdf',
            // 'Content-Disposition' => 'inline; filename="certificate_' . $id . '.pdf"',
            'Content-Disposition' => 'inline; filename="' . $sdoName . '_certificate_' . $id . '.pdf"',
        ]);
    }
}
