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

    public $comparisonType = 'weekly';
    public $financialComparison = [];

    public $startDate = null;
    public $endDate = null;

    public function mount()
    {
        $this->loadData();
    }

    public function setComparison($type)
    {
        $this->comparisonType = $type;
        $this->loadFinancialComparison();
    }

    public function loadData()
    {
        $today = Carbon::today();

        // ================= CASH ADVANCES =================
        $this->cashSummary = [
            'total' => CashAdvance::count(),
            'ongoing' => CashAdvance::where('status', 'Ongoing')->count(),
            'overdue' => CashAdvance::where('status', 'Ongoing')
                                    ->where('payout_end', '<=', $today->copy()->subDays(30))
                                    ->count(),
            'cancelled' => CashAdvance::where('status', 'Cancelled')->count(),
            'fully_liquidated' => CashAdvance::where('status', 'Fully Liquidated')->count(),
        ];

        // ================= LIQUIDATION SUMMARY =================
        $liquidations = Liquidation::all();

        $this->liquidationSummary = [
            'total_for_liquidation' => $liquidations->sum('for_liquidation_amount'),
            'total_pre_audited' => $liquidations->sum('pre_audited_amount'),
            'total_remaining' => $liquidations->sum(
                fn($l) => $l->for_liquidation_amount - $l->pre_audited_amount
            ),
            'statuses' => [
                'For Checking' => $liquidations->where('status', 'For Checking')->sum('for_liquidation_amount'),
                'For Approval' => $liquidations->where('status', 'For Approval')->sum('for_liquidation_amount'),
                'Approved' => $liquidations->where('status', 'Approved')->sum('for_liquidation_amount'),
                'Draft' => $liquidations->where('status', 'Draft')->sum('for_liquidation_amount'),
                'Processing' => $liquidations->where('status', 'Processing')->sum('for_liquidation_amount'),
                'Pre-Audited' => $liquidations->where('status', 'Pre-Audited')->sum('for_liquidation_amount'),
                'Fully Liquidated' => $liquidations->where('status', 'Fully Liquidated')->sum('for_liquidation_amount'),
            ]
        ];

        // ================= BONDED OFFICIALS =================
        $this->bondedSummary = [
            'with_so' => Sdo::whereHas('bondedOfficial')->count(),
            'without_so' => Sdo::whereDoesntHave('bondedOfficial')->count(),
        ];

        $this->loadFinancialComparison();
    }

private function loadFinancialComparison()
{
    $this->financialComparison = [];

    if ($this->comparisonType === 'monthly') {

        for ($month = 1; $month <= 12; $month++) {

            $start = \Carbon\Carbon::create($this->selectedYear, $month, 1)->startOfMonth();
            $end   = \Carbon\Carbon::create($this->selectedYear, $month, 1)->endOfMonth();

            $label = $start->format('M');

            $this->financialComparison[$label] = $this->calculatePeriod($start, $end);
        }
    }

    if ($this->comparisonType === 'yearly') {

        $currentYear = now()->year;

        for ($i = 4; $i >= 0; $i--) {

            $year = $currentYear - $i;

            $start = \Carbon\Carbon::create($year, 1, 1)->startOfYear();
            $end   = \Carbon\Carbon::create($year, 12, 31)->endOfYear();

            $this->financialComparison[$year] = $this->calculatePeriod($start, $end);
        }
    }
}

private function calculatePeriod($start, $end)
{
    return [

        // ✅ CASH ADVANCE — use check_date
        'cash_advance' => CashAdvance::whereBetween('check_date', [$start, $end])
            ->sum('granted_amount'),

        // ✅ LIQUIDATION — use liq_date
        'for_liquidation' => Liquidation::whereBetween('liq_date', [$start, $end])
            ->sum('for_liquidation_amount'),

        'pre_audited' => Liquidation::where('status', 'Pre-Audited')
            ->whereBetween('liq_date', [$start, $end])
            ->sum('pre_audited_amount'),

        'fully_liquidated' => Liquidation::where('status', 'Fully Liquidated')
            ->whereBetween('liq_date', [$start, $end])
            ->sum('for_liquidation_amount'),
    ];
}

    public function render()
    {
        return view('livewire.dashboard');
    }
}