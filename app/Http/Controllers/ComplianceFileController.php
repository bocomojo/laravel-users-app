<?php

namespace App\Http\Controllers;

use App\Models\Liquidation;
use Illuminate\Http\Request;

class ComplianceFileController extends Controller
{
    public function index(Request $request)
    {
        $query = Liquidation::with(['sdo', 'preAuditEntries'])
            ->whereHas('preAuditEntries', function ($q) {
                $q->where('for_compliance', '!=', 0);
            });

        // Search by SDO name or compliance amount
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                // Search by SDO name
                $q->whereHas('sdo', function ($subQuery) use ($search) {
                    $subQuery->where('name', 'like', "%{$search}%");
                })
                // Or by compliance amount
                ->orWhereHas('preAuditEntries', function ($subQuery) use ($search) {
                    $subQuery->where('for_compliance', 'like', "%{$search}%");
                });
            });
        }

        // Date range filter
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('liq_date', [
                $request->start_date,
                $request->end_date
            ]);
        }

        $liquidations = $query->get();

        return view('sdo.compliance.index', compact('liquidations'));
    }
}
