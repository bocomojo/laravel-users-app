<?php

namespace App\Exports;

use App\Models\CashAdvance;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LiquidationsExport implements FromView
{
    protected int|string $cashAdvanceId;

    public function __construct($cashAdvanceId)
    {
        $this->cashAdvanceId = $cashAdvanceId;
    }

    public function view(): View
    {
        $cashAdvance = CashAdvance::with(['sdo', 'papData', 'liquidations'])
            ->findOrFail($this->cashAdvanceId);

        return view('exports.liquidations', [
            'cashAdvance'   => $cashAdvance,
            'liquidations'  => $cashAdvance->liquidations,
        ]);
    }
}
