<?php

namespace App\Exports;

use App\Models\Liquidation;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LiquidationTransmittalExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        // Fetch liquidations grouped by sack number
        $liquidations = Liquidation::query()
            ->select(
                'liquidation.liq_number',
                'liquidation.pre_audited_amount as amount',
                'liquidation.sdo_name',
                'sack_assignment.sack_number'
            )
            ->join('sack_assignment', 'sack_assignment.liq_number', '=', 'liquidation.liq_number')
            ->where('liquidation.status', 'For Transmittal')
            ->orderBy('sack_assignment.sack_number')
            ->orderBy('liquidation.sdo_name')
            ->get()
            ->groupBy('sack_number');

        // Totals
        $totalAmount = $liquidations->flatten()->sum('amount');
        $totalFolders = ''; // intentionally left blank
        $totalSacks = $liquidations->count();

        return view('exports.transmittal', [
            'liquidationsBySack' => $liquidations,
            'totalAmount' => $totalAmount,
            'totalFolders' => $totalFolders,
            'totalSacks' => $totalSacks,
        ]);
    }
}
