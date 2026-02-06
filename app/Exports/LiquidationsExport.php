<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LiquidationsExport implements FromView
{
    protected $liquidations;
    protected $cashAdvance;

    /**
     * Create a new export instance.
     *
     * @param  \Illuminate\Support\Collection  $liquidations
     * @param  \App\Models\CashAdvance         $cashAdvance
     */
    public function __construct($liquidations, $cashAdvance)
    {
        $this->liquidations = $liquidations;
        $this->cashAdvance = $cashAdvance;
    }

    /**
     * Return the view for export.
     */
    public function view(): View
    {
        // ✅ Compute totals (ensure liquidated amount is positive)
        $totalLiquidated = $this->liquidations
    ->filter(function ($liq) {
        return strtolower(trim($liq->liquidation_type ?? '')) === 'liquidation';
    })
    ->sum(fn($liq) => abs($liq->for_liquidation_amount));


        $totalPreAudited = $this->liquidations->sum('pre_audited_amount');
        $totalForCompliance = $this->liquidations->sum('for_compliance_amount');
        $totalRefund = $this->liquidations
            ->where('liquidation_type', 'Refund')
            ->sum('amount');

        // ✅ Attach computed totals to the CashAdvance model
        $this->cashAdvance->total_liquidated = $totalLiquidated;
        $this->cashAdvance->total_pre_audited = $totalPreAudited;
        $this->cashAdvance->total_for_compliance = $totalForCompliance;
        $this->cashAdvance->total_refund = $totalRefund;
dd(
    $this->liquidations
        ->groupBy('liquidation_type')
        ->map(fn($g) => $g->sum('for_liquidation_amount'))
);

        return view('exports.liquidations', [
            'cashAdvance'  => $this->cashAdvance,
            'liquidations' => $this->liquidations,
        ]);
    }
}
