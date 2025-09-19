<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PreAuditor;
use App\Models\PreAuditorLiquidationEntry;

class PreAuditCard extends Component
{
    public PreAuditor $auditor;

    public function render()
    {
        $yesterday = now()->subDay();
        $today = now();

        $yesterdayTotal = PreAuditorLiquidationEntry::where('pre_auditor_id', $this->auditor->id)
            ->whereBetween('created_at', [$yesterday->startOfDay(), $yesterday->endOfDay()])
            ->sum(\DB::raw('amount + for_compliance'));

        $todayTotal = PreAuditorLiquidationEntry::where('pre_auditor_id', $this->auditor->id)
            ->whereBetween('created_at', [$today->startOfDay(), $today->endOfDay()])
            ->sum(\DB::raw('amount + for_compliance'));

        $quota = 2500000;
        $ratio = $quota > 0 ? $todayTotal / $quota : 0;

        return view('livewire.pre-audit-card', compact(
            'yesterdayTotal', 'todayTotal', 'ratio'
        ));
    }
}
