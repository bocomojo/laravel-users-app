<div wire:poll.60s>
    @php
        use App\Models\PreAuditorLiquidationEntry;

        $yesterday = now()->subDay()->toDateString();
        $today = now()->toDateString();

        // Get yesterday & today totals from pre_auditor_liquidation_entries
        $yesterdayTotal = PreAuditorLiquidationEntry::where('pre_auditor_id', $auditor->id)
            ->whereBetween('created_at', [$yesterday . ' 00:00:00', $yesterday . ' 23:59:59'])
            ->sum(\DB::raw('amount + for_compliance'));

        $todayTotal = PreAuditorLiquidationEntry::where('pre_auditor_id', $auditor->id)
            ->whereBetween('created_at', [$today . ' 00:00:00', $today . ' 23:59:59'])
            ->sum(\DB::raw('amount + for_compliance'));

        // Keep assigned/completed counts from liquidations
        $assigned = $auditor->liquidations->count();
        $completed = $auditor->liquidations->where('status', 'Approved')->count();

        // Quota system
        $quota = 2500000;
        $ratio = $todayTotal / $quota;

        $badgeColor = match(true) {
            $ratio >= 1     => 'bg-green-500 text-white',
            $ratio >= 0.6   => 'bg-yellow-400 text-gray-800',
            $ratio >= 0.2   => 'bg-orange-400 text-white',
            default         => 'bg-red-500 text-white',
        };
    @endphp

    <a href="{{ route('pre-auditors.liquidations', $auditor) }}"
       class="block transform transition hover:scale-[1.015]">
        <div class="relative rounded-2xl p-6 shadow-md hover:shadow-xl transition border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
            <div class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center rounded-full text-xs font-bold {{ $badgeColor }}">
                {{ number_format($ratio * 100) }}%
            </div>

            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white truncate">
                    {{ $auditor->name }}
                </h3>
            </div>

            <div class="grid grid-cols-2 gap-2 text-sm text-gray-700 dark:text-gray-300 mb-4">
                <div>
                    <strong>Yesterday</strong><br>
                    ₱{{ number_format($yesterdayTotal, 2) }}
                </div>
                <div>
                    <strong>Today</strong><br>
                    ₱{{ number_format($todayTotal, 2) }}
                </div>
            </div>
        </div>
    </a>
</div>