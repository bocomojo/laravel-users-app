<div wire:poll.60s>
    @php
        $yesterday = now()->subDay()->toDateString();
        $today = now()->toDateString();

        $yesterdayTotal = $auditor->preAuditEntries
            ->whereBetween('created_at', [$yesterday . ' 00:00:00', $yesterday . ' 23:59:59'])
            ->sum(fn($entry) => $entry->amount + $entry->for_compliance);

        $todayTotal = $auditor->preAuditEntries
            ->whereBetween('created_at', [$today . ' 00:00:00', $today . ' 23:59:59'])
            ->sum(fn($entry) => $entry->amount + $entry->for_compliance);

        $assigned = $auditor->liquidation->count();
        $completed = $auditor->liquidation->where('status', 'Approved')->count();

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

            <div class="text-sm text-gray-700 dark:text-gray-300 mb-2">
                <strong>Yesterday:</strong> ₱{{ number_format($yesterdayTotal, 2) }}
            </div>

            <div class="text-sm text-gray-700 dark:text-gray-300 mb-4">
                <strong>Today:</strong> ₱{{ number_format($todayTotal, 2) }}
            </div>

            <div class="flex justify-between items-center text-sm font-medium">
                <span class="text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded-md">
                    Assigned: {{ $assigned }}
                </span>
                <span class="text-green-800 dark:text-green-300 bg-green-100 dark:bg-green-800 px-2 py-1 rounded-md">
                    Approved: {{ $completed }}
                </span>
            </div>
        </div>
    </a>
</div>
