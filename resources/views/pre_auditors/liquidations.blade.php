<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Liquidations for {{ $auditor->name }}
        </h2>
    </x-slot>

    <div class="py-6 px-6">
        <div class="flex flex-col lg:flex-row gap-6">

            <!-- Pre-Auditor Info Card -->
            <div class="w-full lg:w-1/4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm p-6 space-y-6">
                <!-- Auditor Name -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Pre-Auditor</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ $auditor->name }}</p>
                </div>

                <!-- Accomplishments -->
                <div>
                    <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 border-b pb-1 mb-2">Accomplishments</h4>
                    <ul class="space-y-1 text-sm text-gray-700 dark:text-gray-300">
                        <li class="flex justify-between">
                            <span>Yesterday</span>
                            <span class="font-semibold text-gray-900 dark:text-white">₱{{ number_format($yesterdayTotal, 2) }}</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Last Week</span>
                            <span class="font-semibold text-gray-900 dark:text-white">₱{{ number_format($lastWeekTotal, 2) }}</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Last Month</span>
                            <span class="font-semibold text-gray-900 dark:text-white">₱{{ number_format($lastMonthTotal, 2) }}</span>
                        </li>
                    </ul>
                </div>

                <!-- Filter by Date or Month -->
                <div>
                    <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 border-b pb-1 mb-2">Custom Range</h4>
                    <form method="GET" action="{{ route('pre-auditors.show', $auditor->id) }}" class="space-y-2">
                        <div class="flex flex-col space-y-2">
                            <div>
                                <label class="block text-xs text-gray-600 dark:text-gray-400 mb-1">Select Date</label>
                                <input type="date" name="date" class="w-full text-sm rounded border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                            </div>
                            <div>
                                <label class="block text-xs text-gray-600 dark:text-gray-400 mb-1">Select Month</label>
                                <input type="month" name="month" class="w-full text-sm rounded border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                            </div>
                        </div>
                        <div class="flex justify-end pt-2">
                            <button type="submit" class="px-3 py-1 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded">
                                View
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Liquidations Summary -->
                <div>
                    <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 border-b pb-1 mb-2">Liquidations</h4>
                    <ul class="space-y-1 text-sm text-gray-700 dark:text-gray-300">
                        <li class="flex justify-between">
                            <span>Assigned</span>
                            <span class="font-semibold text-gray-900 dark:text-white">{{ $totalAssigned }}</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Completed</span>
                            <span class="font-semibold text-gray-900 dark:text-white">{{ $totalCompleted }}</span>
                        </li>
                        <li class="flex justify-between">
                            <span>For Checking</span>
                            <span class="font-semibold text-gray-900 dark:text-white">{{ $totalForChecking }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Liquidation Table -->
            <div class="w-full lg:w-3/4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg p-6">
                @if($liquidations->count())
                    <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-xs font-semibold">
                            <tr>
                                <th class="px-4 py-2">Liq #</th>
                                <th class="px-4 py-2">SDO</th>
                                <th class="px-4 py-2">Check #</th>
                                <th class="px-4 py-2">Type</th>
                                <th class="px-4 py-2">Amount</th>
                                <th class="px-4 py-2">Pre-Audited</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Received</th>
                                <th class="px-4 py-2 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($liquidations as $liq)
                                @php
                                    $entries = $liq->preAuditEntries
                                        ->where('pre_auditor_id', $auditor->id)
                                        ->sortByDesc('created_at');

                                    $totalPreAudited = $entries->sum(function ($entry) {
                                        return ($entry->amount ?? 0) + ($entry->for_compliance ?? 0);
                                    });

                                    $hasComplianceEntry = $entries->where('for_compliance', '>', 0)->count() > 0;

                                    $isComplete = ($liq->for_liquidation_amount - $totalPreAudited) == 0 && $hasComplianceEntry;
                                @endphp

                                <tr onclick="document.getElementById('entries-{{ $liq->id }}').classList.toggle('hidden')" class="cursor-pointer border-t border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-4 py-2">{{ $liq->liq_number ?? '—' }}</td>
                                    <td class="px-4 py-2">{{ $liq->sdo_name }}</td>
                                    <td class="px-4 py-2">{{ $liq->check_number }}</td>
                                    <td class="px-4 py-2">{{ $liq->liquidation_type }}</td>
                                    <td class="px-4 py-2">₱{{ number_format($liq->for_liquidation_amount, 2) }}</td>
                                    <td class="px-4 py-2">₱{{ number_format($totalPreAudited, 2) }}</td>
                                    <td class="px-4 py-2">{{ $liq->status ?? '—' }}</td>
                                    <td class="px-4 py-2">{{ $liq->liq_date_received ?? '—' }}</td>
                                    <td class="px-4 py-2 text-center space-y-2">
                                        @if($isComplete)
                                            <button class="bg-green-600 hover:bg-green-700 text-white text-xs px-3 py-1 rounded cursor-default">
                                                Complete
                                            </button>
                                        @else
                                            <button 
                                                onclick="event.stopPropagation(); document.getElementById('modal-{{ $liq->id }}').classList.remove('hidden')" 
                                                class="bg-blue-600 hover:bg-blue-700 text-white text-xs px-3 py-1 rounded">
                                                Add Pre-Audited
                                            </button>
                                        @endif
                                    </td>
                                </tr>

                                @if($entries->count())
                                    <tr id="entries-{{ $liq->id }}" class="hidden bg-gray-50 dark:bg-gray-700">
                                        <td colspan="9" class="px-4 py-2">
                                            <table class="w-full text-xs text-left">
                                                <thead>
                                                    <tr class="text-gray-600 dark:text-gray-300">
                                                        <th class="py-1 px-2">Amount</th>
                                                        <th class="py-1 px-2">Type</th>
                                                        <th class="py-1 px-2">Date Submitted</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($entries as $entry)
                                                        @php
                                                            $isCompliance = $entry->for_compliance > 0;
                                                            $displayAmount = $isCompliance ? $entry->for_compliance : $entry->amount;
                                                            $typeLabel = $isCompliance ? 'For Compliance' : 'Complied';
                                                            $textColor = $isCompliance ? 'text-yellow-600' : 'text-green-600';
                                                        @endphp

                                                        @if($displayAmount > 0)
                                                            <tr class="border-t border-gray-300 dark:border-gray-600">
                                                                <td class="py-1 px-2">₱{{ number_format($displayAmount, 2) }}</td>
                                                                <td class="py-1 px-2">
                                                                    <span class="text-xs font-semibold {{ $textColor }}">
                                                                        {{ $typeLabel }}
                                                                    </span>
                                                                </td>
                                                                <td class="py-1 px-2">{{ $entry->created_at->format('M d, Y h:i A') }}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                @endif

                                <!-- Modal -->
                                <div id="modal-{{ $liq->id }}" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center hidden">
                                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg w-full max-w-md">
                                        <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">
                                            Add Pre-Audited Entry — {{ $liq->liq_number }}
                                        </h2>

                                        @if ($errors->any())
                                            <div class="mb-4 bg-red-100 text-red-700 px-4 py-2 rounded">
                                                <ul class="text-sm list-disc pl-5">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <form method="POST" action="{{ route('pre-auditor.liquidations.add-entry') }}">
                                            @csrf
                                            <input type="hidden" name="liquidation_id" value="{{ $liq->id }}">
                                            <input type="hidden" name="pre_auditor_id" value="{{ $auditor->id }}">

                                            <div class="mb-4">
                                                <label class="block text-gray-700 dark:text-gray-300 mb-1">Amount</label>
                                                <input type="number" name="amount" step="0.01" placeholder="₱0.00"
                                                    class="w-full px-3 py-2 border rounded dark:bg-gray-900 dark:border-gray-600 dark:text-white">
                                            </div>

                                            <div class="mb-4">
                                                <label class="block text-gray-700 dark:text-gray-300 mb-1">Entry Type</label>
                                                <select name="for_compliance" class="w-full px-3 py-2 border rounded dark:bg-gray-900 dark:border-gray-600 dark:text-white">
                                                    <option value="0">Complied</option>
                                                    <option value="1">For Compliance</option>
                                                </select>
                                            </div>

                                            <div class="flex justify-end space-x-2">
                                                <button type="button" onclick="document.getElementById('modal-{{ $liq->id }}').classList.add('hidden')" 
                                                    class="px-4 py-2 bg-gray-400 hover:bg-gray-500 text-white rounded">Cancel</button>
                                                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">
                                                    Save
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-gray-500 dark:text-gray-400">No liquidations assigned to this auditor.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
