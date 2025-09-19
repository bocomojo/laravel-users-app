<x-app-layout>
    <!-- =============================
         HEADER
    ============================== -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Liquidations for {{ $auditor->name }}
        </h2>
    </x-slot>

    <div class="py-6 px-6">
        <div class="flex flex-col lg:flex-row gap-6">

            <!-- =============================
                 LEFT CONTAINER (Auditor Info)
            ============================== -->
            <div class="w-full lg:w-1/4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 
                rounded-xl shadow-sm p-6 space-y-6 self-start lg:sticky lg:top-6 h-fit">

                <!-- Auditor Details -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Pre-Auditor</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ $auditor->name }}</p>
                </div>

                <!-- Accomplishments (Today, Yesterday, Last Week) -->
                <div>
                    <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 border-b pb-1 mb-2">
                        Accomplishments
                    </h4>
                    <ul class="space-y-1 text-sm text-gray-700 dark:text-gray-300">
                        <li class="flex justify-between">
                            <span>Today</span>
                            <span class="font-semibold text-gray-900 dark:text-white">
                                ₱{{ number_format($todayTotal ?? 0, 2) }}
                            </span>
                        </li>
                        <li class="flex justify-between">
                            <span>Yesterday</span>
                            <span class="font-semibold text-gray-900 dark:text-white">
                                ₱{{ number_format($yesterdayTotal, 2) }}
                            </span>
                        </li>
                        <li class="flex justify-between">
                            <span>Last Week</span>
                            <span class="font-semibold text-gray-900 dark:text-white">
                                ₱{{ number_format($lastWeekTotal, 2) }}
                            </span>
                        </li>
                    </ul>
                </div>

                <!-- Entries Summary (Totals across all liquidations) -->
                @php
                    $auditorLiquidations = \App\Models\Liquidation::whereHas('preAuditEntries', function($q) use ($auditor) {
                        $q->where('pre_auditor_id', $auditor->user_id);
                    })->with(['preAuditEntries' => function($q) use ($auditor) {
                        $q->where('pre_auditor_id', $auditor->user_id)->orderBy('created_at');
                    }])->get();

                    $totalAudited = 0;
                    $totalCompliance = 0;
                    $totalBalance = 0;
                    $entriesCount = 0;

                    foreach ($auditorLiquidations as $liq) {
                        $runningBalance = 0;
                        foreach ($liq->preAuditEntries as $entry) {
                            $isCompliance = $entry->for_compliance > 0;
                            $displayAmount = $isCompliance ? $entry->for_compliance : $entry->amount;
                            $runningBalance += $isCompliance ? -$displayAmount : $displayAmount;

                            $totalAudited += $entry->amount;
                            $totalCompliance += $entry->for_compliance;
                            $entriesCount++;
                        }
                        $totalBalance += $runningBalance;
                    }
                @endphp

                <div>
                    <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 border-b pb-1 mb-2">
                        Entries Summary
                    </h4>
                    <ul class="space-y-1 text-sm text-gray-700 dark:text-gray-300">
                        <li class="flex justify-between">
                            <span>Total Pre-Audited</span>
                            <span class="font-semibold text-gray-900 dark:text-white">
                                ₱{{ number_format($totalAudited, 2) }}
                            </span>
                        </li>
                        <li class="flex justify-between">
                            <span>Total For Compliance</span>
                            <span class="font-semibold text-gray-900 dark:text-white">
                                ₱{{ number_format($totalCompliance, 2) }}
                            </span>
                        </li>
                        <li class="flex justify-between">
                            <span>Total Balance</span>
                            <span class="font-semibold text-gray-900 dark:text-white">
                                ₱{{ number_format($totalBalance, 2) }}
                            </span>
                        </li>
                        <li class="flex justify-between">
                            <span>Number of Entries</span>
                            <span class="font-semibold text-gray-900 dark:text-white">{{ $entriesCount }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- =============================
                 RIGHT CONTAINER (Main Content)
            ============================== -->
            <div class="w-full lg:w-3/4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg p-6">

                <!-- =============================
                     FILTERS TOOLBAR
                     (Flexible, Compact)
                ============================== -->
                <div class="flex flex-wrap items-center gap-3 mb-4">
                    <!-- Date Range -->
                    <input type="date" name="start_date" value="{{ request('start_date') }}"
                        class="px-3 py-2 border rounded-md text-sm 
                               bg-white dark:bg-gray-700 
                               border-gray-300 dark:border-gray-600 
                               text-gray-800 dark:text-gray-200
                               focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                        class="px-3 py-2 border rounded-md text-sm 
                               bg-white dark:bg-gray-700 
                               border-gray-300 dark:border-gray-600 
                               text-gray-800 dark:text-gray-200
                               focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                    <!-- Apply Button -->
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-md">
                        Apply Filter
                    </button>

                    <!-- Clear Button (only shows if filter is active) -->
                    @if(request()->hasAny(['type','status','start_date','end_date']))
                        <a href="{{ route('pre-auditors.liquidations', $auditor->id) }}"
                            class="bg-gray-600 hover:bg-gray-700 text-white text-sm px-4 py-2 rounded-md">
                            Clear
                        </a>
                    @endif

                    <!-- Search (floats right) -->
                    <div class="ml-auto flex items-center gap-2">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..."
                            class="px-3 py-2 border rounded-md text-sm w-56
                                   bg-white dark:bg-gray-700 
                                   border-gray-300 dark:border-gray-600 
                                   text-gray-800 dark:text-gray-200
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-md">
                            Search
                        </button>
                    </div>
                </div>

                @php
                    // =============================
                    // QUERY FILTERED LIQUIDATIONS
                    // =============================
                    $filteredLiquidations = collect();
                    $grandTotalBalance = 0;
                    $grandTotalAudited = 0;
                    $grandTotalCompliance = 0;

                    if (request('start_date') && request('end_date')) {
                        $start = request('start_date') . ' 00:00:00';
                        $end = request('end_date') . ' 23:59:59';

                        $filteredLiquidations = \App\Models\Liquidation::whereHas('preAuditEntries', function($q) use ($auditor, $start, $end) {
                                $q->where('pre_auditor_id', $auditor->user_id)
                                  ->whereBetween('created_at', [$start, $end]);
                            })
                            ->with(['preAuditEntries' => function($q) use ($auditor, $start, $end) {
                                $q->where('pre_auditor_id', $auditor->user_id)
                                  ->whereBetween('created_at', [$start, $end])
                                  ->orderBy('created_at');
                            }])
                            ->get();
                    }
                @endphp

                @if(request('start_date') && request('end_date'))
                    <!-- =============================
                         FILTERED RESULTS
                    ============================== -->
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                        Filtered Results ({{ request('start_date') }} → {{ request('end_date') }})
                    </h3>

                    @forelse($filteredLiquidations as $liq)
                        @php
                            $liqRunningBalance = 0;
                            $liqTotal = 0;
                            $liqCompliance = 0;
                        @endphp

                        <!-- Each Liquidation Block -->
                        <div class="mb-6 border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                            <!-- Header -->
                            <div class="bg-gray-100 dark:bg-gray-700 px-4 py-2 font-semibold text-gray-800 dark:text-gray-200">
                                Liq #{{ $liq->liq_number ?? '—' }}
                            </div>

                            <!-- Table -->
                            <table class="w-full text-sm text-left">
                                <thead class="bg-gray-50 dark:bg-gray-800">
                                    <tr>
                                        <th class="py-2 px-3 text-gray-700 dark:text-gray-300">Type</th>
                                        <th class="py-2 px-3 text-gray-700 dark:text-gray-300">Amount</th>
                                        <th class="py-2 px-3 text-gray-700 dark:text-gray-300">Running Balance</th>
                                        <th class="py-2 px-3 text-gray-700 dark:text-gray-300">Date Submitted</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($liq->preAuditEntries->sortBy('created_at') as $entry)
                                        @php
                                            $isCompliance = $entry->for_compliance > 0;
                                            $displayAmount = $isCompliance ? $entry->for_compliance : $entry->amount;
                                            $typeLabel = $isCompliance ? 'For Compliance' : 'Pre-Audited';
                                            $textColor = $isCompliance ? 'text-yellow-600 dark:text-yellow-400' : 'text-green-600 dark:text-green-400';

                                            // Running balance logic (compliance subtracts)
                                            $liqRunningBalance += $isCompliance ? -$displayAmount : $displayAmount;

                                            // Totals for this liquidation
                                            $liqTotal += $entry->amount;
                                            $liqCompliance += $entry->for_compliance;
                                        @endphp
                                        <tr class="border-t border-gray-200 dark:border-gray-600">
                                            <td class="py-1 px-3">
                                                <span class="font-semibold {{ $textColor }}">{{ $typeLabel }}</span>
                                            </td>
                                            <td class="py-1 px-3 text-gray-900 dark:text-gray-100">
                                                ₱{{ number_format($displayAmount, 2) }}
                                            </td>
                                            <td class="py-1 px-3 font-semibold text-gray-900 dark:text-gray-100">
                                                ₱{{ number_format($liqRunningBalance, 2) }}
                                            </td>
                                            <td class="py-1 px-3 text-gray-700 dark:text-gray-300">
                                                {{ $entry->created_at->format('M d, Y h:i A') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                                <!-- Totals -->
                                <tfoot class="bg-gray-50 dark:bg-gray-800 font-semibold">
                                    <tr>
                                        <td class="py-2 px-3 text-gray-800 dark:text-gray-200">
                                            Total Pre-Audited: ₱{{ number_format($liqTotal, 2) }}
                                        </td>
                                        <td class="py-2 px-3 text-gray-800 dark:text-gray-200">
                                            For Compliance: ₱{{ number_format($liqCompliance, 2) }}
                                        </td>
                                        <td class="py-2 px-3 text-gray-800 dark:text-gray-200">
                                            Balance: ₱{{ number_format($liqRunningBalance, 2) }}
                                        </td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        @php
                            // Accumulate grand totals
                            $grandTotalBalance += $liqRunningBalance;
                            $grandTotalAudited += $liqTotal;
                            $grandTotalCompliance += $liqCompliance;
                        @endphp
                    @empty
                        <p class="text-gray-500 dark:text-gray-400">
                            No entries found in this date range.
                        </p>
                    @endforelse

                    <!-- Grand Totals -->
                    <div class="mt-6 p-4 border-t border-gray-300 dark:border-gray-600">
                        <h4 class="text-md font-bold text-gray-800 dark:text-gray-200 mb-2">Grand Totals</h4>
                        <ul class="text-sm text-gray-700 dark:text-gray-300 space-y-1">
                            <li>Total Pre-Audited: ₱{{ number_format($grandTotalAudited, 2) }}</li>
                            <li>Total For Compliance: ₱{{ number_format($grandTotalCompliance, 2) }}</li>
                            <li class="font-semibold text-gray-900 dark:text-white">
                                Balance: ₱{{ number_format($grandTotalBalance, 2) }}
                            </li>
                        </ul>
                    </div>
                @else
                    <!-- =============================
                         DEFAULT VIEW (No Filters)
                    ============================== -->
                    @php
                        $auditorLiquidations = \App\Models\Liquidation::whereHas('preAuditEntries', function($q) use ($auditor) {
                            $q->where('pre_auditor_id', $auditor->user_id);
                        })->get();
                    @endphp

                    @if($auditorLiquidations->count())
                        <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
                            <thead class="bg-gray-100 dark:bg-gray-700 text-xs font-semibold">
                                <tr>
                                    <th class="px-4 py-2">Liq #</th>
                                    <th class="px-4 py-2">Amount</th>
                                    <th class="px-4 py-2">Entries Count</th>
                                    <th class="px-4 py-2">Status</th>
                                    <th class="px-4 py-2">Received</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($auditorLiquidations as $liq)
                                    @php
                                        $entries = $liq->preAuditEntries()
                                            ->where('pre_auditor_id', $auditor->user_id)
                                            ->orderByDesc('created_at')
                                            ->get();
                                    @endphp

                                    <!-- Collapsible Parent Row -->
                                    <tr onclick="document.getElementById('entries-{{ $liq->id }}').classList.toggle('hidden')" 
                                        class="cursor-pointer border-t border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <td class="px-4 py-2">{{ $liq->liq_number ?? '—' }}</td>
                                        <td class="px-4 py-2">₱{{ number_format($liq->for_liquidation_amount, 2) }}</td>
                                        <td class="px-4 py-2">{{ $entries->count() }}</td>
                                        <td class="px-4 py-2">{{ $liq->status ?? '—' }}</td>
                                        <td class="px-4 py-2">{{ $liq->liq_date_received ?? '—' }}</td>
                                    </tr>

                                    <!-- Collapsible Entries -->
                                    @if($entries->count())
                                        <tr id="entries-{{ $liq->id }}" class="hidden bg-gray-50 dark:bg-gray-700">
                                            <td colspan="5" class="px-4 py-2">
                                                <table class="w-full text-xs text-left">
                                                    <thead>
                                                        <tr class="text-gray-600 dark:text-gray-300">
                                                            <th class="py-1 px-2">Liq #</th>
                                                            <th class="py-1 px-2">Type</th>
                                                            <th class="py-1 px-2">Amount</th>
                                                            <th class="py-1 px-2">Running Balance</th>
                                                            <th class="py-1 px-2">Date Submitted</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php 
                                                            $runningBalance = 0; 
                                                            $totalPreAudited = 0;
                                                            $totalCompliance = 0;
                                                        @endphp
                                                        @foreach($entries as $entry)
                                                            @php
                                                                $isCompliance = $entry->for_compliance > 0;
                                                                $displayAmount = $isCompliance ? $entry->for_compliance : $entry->amount;
                                                                $typeLabel = $isCompliance ? 'For Compliance' : 'Pre-Audited';
                                                                $textColor = $isCompliance ? 'text-yellow-600 dark:text-yellow-400' : 'text-green-600 dark:text-green-400';
                                                                $runningBalance += $isCompliance ? -$displayAmount : $displayAmount;

                                                                $totalPreAudited += $entry->amount;
                                                                $totalCompliance += $entry->for_compliance;
                                                            @endphp
                                                            <tr class="border-t border-gray-300 dark:border-gray-600">
                                                                <td class="py-1 px-2">{{ $liq->liq_number ?? '—' }}</td>
                                                                <td class="py-1 px-2">
                                                                    <span class="text-xs font-semibold {{ $textColor }}">
                                                                        {{ $typeLabel }}
                                                                    </span>
                                                                </td>
                                                                <td class="py-1 px-2">₱{{ number_format($displayAmount, 2) }}</td>
                                                                <td class="py-1 px-2 font-semibold text-gray-900 dark:text-white">
                                                                    ₱{{ number_format($runningBalance, 2) }}
                                                                </td>
                                                                <td class="py-1 px-2">{{ $entry->created_at->format('M d, Y h:i A') }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot class="bg-gray-100 dark:bg-gray-800 font-semibold">
                                                        <tr>
                                                            <td class="py-1 px-2 text-gray-800 dark:text-gray-200">Totals:</td>
                                                            <td class="py-1 px-2 text-gray-800 dark:text-gray-200">Pre-Audited: ₱{{ number_format($totalPreAudited, 2) }}</td>
                                                            <td class="py-1 px-2 text-gray-800 dark:text-gray-200">Compliance: ₱{{ number_format($totalCompliance, 2) }}</td>
                                                            <td class="py-1 px-2 text-gray-800 dark:text-gray-200">Balance: ₱{{ number_format($runningBalance, 2) }}</td>
                                                            <td></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">
                            No liquidations associated with this auditor.
                        </p>
                    @endif
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
