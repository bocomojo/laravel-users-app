<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cash Advance Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto px-4 lg:px-8 mb-4 flex justify-between items-center">
            <a href="{{ route('liquidation.export', $cashAdvance->id) }}"
               class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-md shadow transition">
                ↓ Export to Excel
            </a>
            <x-back-button label="← Return to Previous Page"/>
        </div>

        <div class="flex flex-col lg:flex-row gap-6 max-w-full mx-auto px-4 lg:px-8">
            <div class="w-full lg:w-1/3" x-data="{ editDates: false }">
                <div class="bg-white dark:bg-gray-800 text-gray-800 dark:text-white shadow-xl hover:shadow-2xl transition-shadow duration-300 rounded-xl p-6 space-y-6">
                    <div>
                        <h3 class="text-xl font-semibold mb-2 border-b border-gray-600 pb-2 flex justify-between items-center">
                            Cash Advance Details
                            <div x-data="{ showHistory: false }">
                                <!-- history button -->
                                <button @click="showHistory = true" class="text-sm text-blue-400 hover:underline">
                                    Show Payout Date History
                                </button>

                                <!-- history of payout date changes Modal -->
                                <div x-show="showHistory" x-cloak class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-2xl overflow-y-auto max-h-[80vh]">
                                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">History of Payout Date changes</h2>

                                        <table class="w-full text-sm text-left">
                                            <thead class="text-xs text-gray-700 uppercase dark:text-gray-300 border-b">
                                                <tr>
                                                    <th>Old Start</th>
                                                    <th>Old End</th>
                                                    <th>New Start</th>
                                                    <th>New End</th>
                                                    <th>Changed At</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y dark:divide-gray-600">
                                                @foreach ($cashAdvance->payoutDateHistories as $history)
                                                    <tr>
                                                        <td>{{ $history->old_start ?? '—' }}</td>
                                                        <td>{{ $history->old_end ?? '—' }}</td>
                                                        <td>{{ $history->new_start }}</td>
                                                        <td>{{ $history->new_end }}</td>
                                                        <td>{{ $history->changed_at->format('Y-m-d H:i') }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <div class="mt-4 flex justify-end">
                                            <button @click="showHistory = false" class="px-4 py-2 bg-gray-500 text-white rounded">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Edit payout date -->
                            <button @click="editDates = true" class="text-sm text-blue-400 hover:underline" title="Edit Payout Dates">
                                Edit
                            </button>
                        </h3>
                        <div class="mb-4">
                            <p class="text-medium text-gray-800 dark:text-gray-300">
                                <span class="font-medium text-gray-900 dark:text-white">Name:</span>
                                {{ $cashAdvance->sdo->name ?? 'N/A' }}
                            </p>
                            <p class="font-medium text-gray-900 dark:text-white">
                                <span class="font-medium text-gray-900 dark:text-white">Particulars:
                                {{ $cashAdvance->particulars ?? 'N/A' }}</span>
                            </p>
                        </div>

                        <div class="mb-4 space-y-1 text-sm text-gray-800 dark:text-white">
                            <p>
                                <span class="font-medium text-gray-900 dark:text-white">PAP:</span>
                                <span class="text-gray-800 dark:text-gray-300">
                                    {{ $cashAdvance->papData->pap_name ?? 'N/A' }}
                                </span>
                            </p>
                            <p>
                                <span class="font-medium text-gray-900 dark:text-white">Start of Payout:</span>
                                <span class="text-gray-800 dark:text-gray-300">
                                    {{ $cashAdvance->payout_start ? \Carbon\Carbon::parse($cashAdvance->payout_start)->format('F j, Y') : '—' }}
                                </span>
                            </p>
                            <p>
                                <span class="font-medium text-gray-900 dark:text-white">End of Payout:</span>
                                <span class="text-gray-800 dark:text-gray-300">
                                    {{ $cashAdvance->payout_end ? \Carbon\Carbon::parse($cashAdvance->payout_end)->format('F j, Y') : '—' }}
                                </span>
                            </p>
                            <p>
                                @if ($cashAdvance->payout_attachment)
                                    <a href="{{ asset('storage/' . $cashAdvance->payout_attachment) }}" target="_blank" class="text-blue-600 dark:text-blue-400 underline">
                                        📄 View Attached File
                                    </a>
                                @endif
                            </p>
                            <p>
                                <span class="font-medium text-gray-900 dark:text-white">Due Date:</span>
                                <span class="text-gray-800 dark:text-gray-300">
                                    {{ $cashAdvance->payout_end ? \Carbon\Carbon::parse($cashAdvance->payout_end)->addDays(31)->format('F j, Y') : '—' }}
                                </span>
                            </p>
                        </div>

                        <table class="w-full text-sm text-gray-800 dark:text-gray-300 table-fixed border-collapse mb-4">
                            <tbody>
                                <tr>
                                    <td class="font-medium text-gray-900 dark:text-white py-2 pr-4 w-1/3">Check Number</td>
                                    <td class="py-2 pr-4">{{ $cashAdvance->check_number ?? 'N/A' }}</td>
                                    <td class="py-2">{{ $cashAdvance->check_date ? \Carbon\Carbon::parse($cashAdvance->check_date)->format('m/d/Y') : 'N/A' }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Granted Amount -->
                        <div class="flex justify-between text-sm text-gray-800 dark:text-white border-t border-gray-300 dark:border-gray-600 pt-4">
                            <span class="font-semibold">Granted Amount:</span>
                            <span>{{ number_format($cashAdvance->granted_amount, 2) }}</span>
                        </div>

                        <!-- Total Liquidation Received -->
                        <div class="flex justify-between text-sm text-gray-800 dark:text-white pt-4">
                            <span class="font-semibold">Total Liquidation Received:</span>
                            <span>{{ number_format($totalLiquidationReceived, 2) }}</span>
                        </div>

                        <!-- Total Pre-Audited -->
                        <div class="flex justify-between text-sm text-gray-800 dark:text-white pt-4">
                            <span class="font-semibold">Total Pre-Audited:</span>
                            <span>{{ number_format($totalPreAudited, 2) }}</span>
                        </div>

                        <!-- Total For Compliance -->
                        <div class="flex justify-between text-sm text-gray-800 dark:text-white pt-4">
                            <span class="font-semibold">Total For Compliance:</span>
                            <span>{{ number_format($totalForCompliance, 2) }}</span>
                        </div>

                        <!-- Total Refund -->
                        <div class="flex justify-between text-sm text-gray-800 dark:text-white pt-4">
                            <span class="font-semibold">Total Refund:</span>
                            <span>{{ number_format($totalRefund, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Edit Modal -->
                <div x-show="editDates" x-cloak class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Edit Payout Dates</h2>

                        <form method="POST"
                            action="{{ route('cash-advance.update-dates', $cashAdvance->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Start Date --}}
                            <div class="mb-4">
                                <label for="payout_start" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Start of Payout <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="payout_start" id="payout_start"
                                    value="{{ old('payout_start', $cashAdvance->payout_start) }}"
                                    required
                                    class="mt-1 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm">
                            </div>

                            {{-- End Date --}}
                            <div class="mb-4">
                                <label for="payout_end" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    End of Payout <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="payout_end" id="payout_end"
                                    value="{{ old('payout_end', $cashAdvance->payout_end) }}"
                                    required
                                    class="mt-1 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm">
                            </div>

                            {{-- File Upload --}}
                            <div class="mb-4">
                                <label for="attachment" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Upload Required Document <span class="text-red-500">*</span>
                                </label>
                                <input type="file" name="attachment" id="attachment"
                                    accept=".pdf,.jpg,.jpeg,.png"
                                    required
                                    class="mt-1 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm">
                            </div>

                            {{-- Actions --}}
                            <div class="flex justify-end space-x-2">
                                <button type="button"
                                        @click="editDates = false"
                                        class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-white rounded">
                                    Cancel
                                </button>
                                <button type="submit"
                                        class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right container: Liquidation Table -->
            <div x-data="{ showModal: false, deleteId: null }" class="w-full lg:w-2/3">
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 overflow-x-auto">
                    
                    <!-- Header -->
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                            Related Liquidations
                        </h3>
                        <div class="text-sm text-right space-y-1">
                            <p class="text-gray-700 dark:text-gray-300">
                                <span class="font-semibold">Starting Balance:</span>
                                {{ number_format($cashAdvance->granted_amount, 2) }}
                            </p>

                            @php
                                $totalPreAudited = $liquidations->sum('pre_audited_amount');
                                $refunds = $liquidations->where('liquidation_type', 'Refund')->sum('for_liquidation_amount');
                                $remainingBalance = $cashAdvance->granted_amount - $totalPreAudited + $refunds;
                            @endphp

                            <p class="text-gray-700 dark:text-gray-300">
                                <span class="font-semibold">Remaining Balance:</span>
                                {{ number_format($remainingBalance, 2) }}
                            </p>
                        </div>
                    </div>

                    <!-- Sorting & Filtering -->
                    <form method="GET" class="mb-4 flex flex-wrap items-center gap-4">
                        <!-- <div>
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300 mr-2">Sort:</label>
                            <select name="sort" onchange="this.form.submit()" 
                                    class="bg-gray-100 dark:bg-gray-700 text-sm text-gray-800 dark:text-white rounded p-2">
                                <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Newest First</option>
                                <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Oldest First</option>
                            </select>
                        </div> -->
                        <div>
                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300 mr-2">Filter:</label>
                            <select name="type" onchange="this.form.submit()" 
                                    class="bg-gray-100 dark:bg-gray-700 text-sm text-gray-800 dark:text-white rounded p-2">
                                <option value="">All</option>
                                <option value="Liquidation" {{ request('type') == 'Liquidation' ? 'selected' : '' }}>Liquidation</option>
                                <option value="Refund" {{ request('type') == 'Refund' ? 'selected' : '' }}>Refund</option>
                            </select>
                        </div>
                    </form>

                    <!-- Table -->
                    <div class="relative max-h-[500px] overflow-auto border border-gray-300 dark:border-gray-700 rounded-lg">
                        <table class="min-w-[1300px] table-fixed text-sm text-left text-gray-800 dark:text-gray-200">
                            <thead class="sticky top-0 bg-gray-100 dark:bg-gray-800 z-20">
                                <tr>
                                    <th class="px-4 py-3 text-xs font-bold uppercase border-b">Transaction Type</th>
                                    <th class="px-4 py-3 text-xs font-bold uppercase border-b">Reference (LR/OR)</th>
                                    <th class="px-4 py-3 text-xs font-bold uppercase border-b">Date Received</th>
                                    <th class="px-4 py-3 text-xs font-bold uppercase border-b">Date Reviewed</th>
                                    <th class="px-4 py-3 text-xs font-bold uppercase border-b">Liq Amount Received</th>
                                    <th class="px-4 py-3 text-xs font-bold uppercase border-b">Amount for Compliance</th>
                                    <th class="px-4 py-3 text-xs font-bold uppercase border-b">Pre-Audited Amount</th>
                                    <th class="px-4 py-3 text-xs font-bold uppercase border-b">Running Balance</th>
                                    <th class="px-4 py-3 text-xs font-bold uppercase border-b">JEV No.</th>
                                    <th class="px-4 py-3 text-xs font-bold uppercase border-b">Pre-Auditor</th>
                                    <th class="px-4 py-3 text-xs font-bold uppercase border-b">Attachments</th>
                                </tr>
                            </thead>

                            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-800">
                                @if ($liquidations->isEmpty())
                                    <tr>
                                        <td colspan="11" class="px-4 py-4 text-center text-gray-600 dark:text-gray-400">
                                            No liquidations found for this cash advance.
                                        </td>
                                    </tr>
                                @else
                                    @php
                                        $runningBalance = $cashAdvance->granted_amount;
                                    @endphp
                                    @foreach ($liquidations as $liquidation)
                                        @php
                                            // Deduct pre-audited amount
                                            $runningBalance -= $liquidation->pre_audited_amount ?? 0;
                                        @endphp
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                            <td class="px-4 py-2">{{ $liquidation->liquidation_type }}</td>
                                            <td class="px-4 py-2">
                                                @if ($liquidation->liquidation_type === 'Refund')
                                                    {{ $liquidation->or_number ?? '—' }}
                                                @elseif ($liquidation->liquidation_type === 'Liquidation')
                                                    {{ $liquidation->liq_number ?? '—' }}
                                                @else
                                                    —
                                                @endif
                                            </td>
                                            <td class="px-4 py-2">
                                                {{ $liquidation->liq_date_received ? \Carbon\Carbon::parse($liquidation->liq_date_received)->format('F d, Y') : '—' }}
                                            </td>
                                            <td class="px-4 py-2">
                                                {{ $liquidation->liq_date ? \Carbon\Carbon::parse($liquidation->liq_date)->format('F d, Y') : '—' }}
                                            </td>
                                            <td class="px-4 py-2">
                                                {{ $liquidation->for_liquidation_amount < 0
                                                    ?  number_format(abs($liquidation->for_liquidation_amount), 2)
                                                    : number_format($liquidation->for_liquidation_amount, 2) }}
                                            </td>
                                            <td class="px-4 py-2 text-black dark:text-white">
                                                {{ '(' . number_format($liquidation->for_compliance_amount, 2) . ')' }}
                                            </td>
                                            <td class="px-4 py-2 text-black dark:text-white">
                                                {{ $liquidation->pre_audited_amount < 0
                                                    ? '(' . number_format(abs($liquidation->pre_audited_amount), 2) . ')'
                                                    : number_format($liquidation->pre_audited_amount, 2) }}
                                            </td>
                                            <!-- ✅ Running Balance -->
                                            <td class="px-4 py-2 font-semibold text-black dark:text-white">
                                                {{ number_format($runningBalance, 2) }}
                                            </td>


                                            <!-- JEV No -->
                                            <td class="px-4 py-2" x-data>
                                                @if (empty($liquidation->jev_no))
                                                    @hasanyrole('admin|reporting')
                                                        <button 
                                                            @click="$dispatch('open-jev-modal', { id: {{ $liquidation->id }}, jev: '' })"
                                                            class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md shadow">
                                                            Add JEV
                                                        </button>
                                                    @else
                                                        <span class="text-gray-400 italic">— Restricted —</span>
                                                    @endhasanyrole
                                                @else
                                                    <button 
                                                        @click="$dispatch('open-jev-modal', { id: {{ $liquidation->id }}, jev: '{{ $liquidation->jev_no }}' })"
                                                        class="text-blue-600 dark:text-blue-400 underline">
                                                        {{ $liquidation->jev_no }}
                                                    </button>
                                                @endif
                                            </td>
                                            
                                            <!-- ✅ Pre-Auditors column -->
                                            <td class="px-4 py-2 align-top">
                                                @php
                                                    $auditors = $liquidation->preAuditEntries
                                                        ->whereNotNull('pre_auditor_id')
                                                        ->unique('pre_auditor_id');
                                                @endphp

                                                @if ($auditors->isNotEmpty())
                                                    <div x-data="{ open: false }" class="text-sm">
                                                        <button 
                                                            @click="open = !open" 
                                                            class="text-blue-600 dark:text-blue-400 hover:underline font-medium">
                                                            <span x-text="open ? 'Hide : 'Show'"></span>
                                                        </button>

                                                        <div x-show="open" class="mt-1 space-y-1">
                                                            @foreach ($auditors as $entry)
                                                                <div class="text-gray-700 dark:text-gray-300 truncate">
                                                                    • {{ $entry->preAuditor->name ?? '—' }}
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @else
                                                    <span class="text-gray-400 italic">No pre-auditors</span>
                                                @endif
                                            </td>

                                            <!-- Attachments (deduped) -->
                                            <td class="px-4 py-2 text-sm text-blue-600 dark:text-blue-400 align-top">
                                                @if ($liquidation->preAuditEntries->isNotEmpty())
                                                    @php
                                                        $uniqueFiles = $liquidation->preAuditEntries
                                                            ->filter(fn($entry) => !empty($entry->compliance_file))
                                                            ->unique('compliance_file');
                                                    @endphp

                                                    @if ($uniqueFiles->isNotEmpty())
                                                        <div x-data="{ open: false }">
                                                            <button @click="open = !open" 
                                                                    class="text-blue-500 hover:text-blue-700 underline">
                                                                <span x-text="open ? 'Hide' : 'Show'"></span>
                                                            </button>

                                                            <div x-show="open" class="mt-2 space-y-1">
                                                                @foreach ($uniqueFiles as $entry)
                                                                    <a href="{{ asset('storage/' . $entry->compliance_file) }}"
                                                                    target="_blank"
                                                                    class="block underline hover:text-blue-800 dark:hover:text-blue-300 truncate max-w-[220px]">
                                                                        📎 {{ $entry->compliance_file_name ?? 'View File' }}
                                                                    </a>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @else
                                                        <span class="text-gray-400 italic">No attachments</span>
                                                    @endif
                                                @else
                                                    <span class="text-gray-400 italic">No attachments</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

                        <!-- ✅ JEV Modal -->
                        <div x-data="{ openJevModal: null, jevNo: '' }"
                            @open-jev-modal.window="openJevModal = $event.detail.id; jevNo = $event.detail.jev">
                            <div x-show="openJevModal" x-cloak
                                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
                                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Add / Edit JEV</h2>
                                    <form @submit.prevent="
                                        fetch(`/liquidation/${openJevModal}/jev`, {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                            },
                                            body: JSON.stringify({ jev_no: jevNo })
                                        })
                                        .then(res => res.json())
                                        .then(data => {
                                            if(data.success) {
                                                $dispatch('show-msg', { type: 'success', message: `JEV updated: ${data.jev_no}` });
                                                openJevModal = null;
                                                setTimeout(() => location.reload(), 1200);
                                            } else {
                                                $dispatch('show-msg', { type: 'fail', message: data.message || 'Failed to update JEV.' });
                                            }
                                        })
                                    ">
                                        <label class="block mb-2 text-gray-700 dark:text-gray-300">JEV Number</label>
                                        <input type="text" x-model="jevNo" 
                                            class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white p-2 mb-4" required>

                                        <div class="flex justify-end space-x-2">
                                            <button type="button" @click="openJevModal = null" 
                                                    class="px-4 py-2 bg-gray-300 dark:bg-gray-600 rounded text-gray-800 dark:text-white">
                                                Cancel
                                            </button>
                                            <button type="submit" 
                                                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">
                                                Save
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Confirmation Modal -->
                    <div x-show="showModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                        <div class="bg-white dark:bg-gray-900 rounded-lg p-6 w-full max-w-md shadow-lg">
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Confirm Deletion</h2>
                            <p class="text-gray-700 dark:text-gray-300 mb-6">Are you sure you want to delete this liquidation record? This action cannot be undone.</p>
                            <div class="flex justify-end space-x-4">
                                <button @click="showModal = false" type="button" 
                                        class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-white rounded">Cancel</button>
                                <form :action="`/liquidation/${deleteId}`" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



</x-app-layout>
