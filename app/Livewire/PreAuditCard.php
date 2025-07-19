<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PreAuditor;

class PreAuditCard extends Component
{
    public PreAuditor $auditor;

    public function render()
    {
        $yesterday = now()->subDay();
        $today = now();

        $yesterdayTotal = $this->auditor->preAuditEntries
            ->whereBetween('created_at', [$yesterday->startOfDay(), $yesterday->endOfDay()])
            ->sum(fn($entry) => $entry->amount + $entry->for_compliance);

        $todayTotal = $this->auditor->preAuditEntries
            ->whereBetween('created_at', [$today->startOfDay(), $today->endOfDay()])
            ->sum(fn($entry) => $entry->amount + $entry->for_compliance);

        $assigned = $this->auditor->liquidation->count();
        $completed = $this->auditor->liquidation->where('status', 'Approved')->count();

        $quota = 2500000;
        $ratio = $quota > 0 ? $todayTotal / $quota : 0;

        return view('livewire.pre-audit-card', compact(
            'yesterdayTotal', 'todayTotal', 'assigned', 'completed', 'ratio'
        ));
    }
}
