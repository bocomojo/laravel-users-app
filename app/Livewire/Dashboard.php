<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CashAdvance;
use App\Models\Liquidation;
use App\Models\Sdo;
use Carbon\Carbon;

class Dashboard extends Component
{
    public $cashSummary = [];
    public $liquidationSummary = [];
    public $bondedSummary = [];

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $today = Carbon::today();

        // --- Cash Advances ---
        $this->cashSummary = [
            'total' => CashAdvance::count(),
            'ongoing' => CashAdvance::where('status', 'Ongoing')->count(),
            'overdue' => CashAdvance::where('status', 'Ongoing')
                                    ->where('payout_end', '<=', $today->subDays(30))
                                    ->count(),
            'cancelled' => CashAdvance::where('status', 'Cancelled')->count(),
            'fully_liquidated' => CashAdvance::where('status', 'Fully Liquidated')->count(),
        ];

        // --- Liquidations ---
        $liquidations = Liquidation::all();
        $this->liquidationSummary = [
            'total_for_liquidation' => $liquidations->sum('for_liquidation_amount'),
            'total_pre_audited' => $liquidations->sum('pre_audited_amount'),
            'total_remaining' => $liquidations->sum(fn($l) => $l->for_liquidation_amount - $l->pre_audited_amount),
            'statuses' => [
                'For Checking' => $liquidations->where('status', 'For Checking')->sum('for_liquidation_amount'),
                'For Approval' => $liquidations->where('status', 'For Approval')->sum('for_liquidation_amount'),
                'Approved' => $liquidations->where('status', 'Approved')->sum('for_liquidation_amount'),
                'Draft' => $liquidations->where('status', 'Draft')->sum('for_liquidation_amount'),
                'Processing' => $liquidations->where('status', 'Processing')->sum('for_liquidation_amount'),
            ]
        ];

        // --- Bonded Officials ---
        $this->bondedSummary = [
            'with_so' => Sdo::whereHas('bondedOfficial')->count(),
            'without_so' => Sdo::whereDoesntHave('bondedOfficial')->count(),
        ];
    }

    public function render()
    {
        $this->loadData();
        return view('livewire.dashboard');
    }
}
