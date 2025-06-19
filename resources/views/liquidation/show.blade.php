<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cash Advance Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
    
        <div class="max-w-full mx-auto px-4 lg:px-8 mb-4 flex justify-between items-center">
            <!-- Export Button -->
            <a href="{{ route('liquidation.export', $cashAdvance->id) }}"
            class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded-md shadow transition">
                ↓ Export to Excel
            </a>

            <!-- Return Button -->
            <a href="{{ route('liquidation.index') }}"
            class="inline-block bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white px-4 py-2 rounded-md shadow hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                ← Return to Cash Advances
            </a>
        </div>

        <div class="flex flex-col lg:flex-row gap-6 max-w-full mx-auto px-4 lg:px-8">

            <!-- Left container: Cash Advance Summary -->
            <div class="w-full lg:w-1/3">
                <div class="bg-[#1f2937] text-white shadow-xl hover:shadow-2xl transition-shadow duration-300 rounded-xl p-6 border border-gray-700 space-y-6">
                    <div>
                        <h3 class="text-xl font-semibold mb-2 border-b border-gray-600 pb-2">Cash Advance Details</h3>
                        <div class="mb-4">
                            <p class="text-sm text-gray-300">
                                <span class="font-medium text-white">Name:</span> {{ $cashAdvance->sdo->name ?? 'N/A' }}
                            </p>
                        </div>
                        <div class="mb-4">
                            <p class="text-sm font-medium text-white mb-1">Particulars:</p>
                            <p class="text-sm text-gray-300 text-justify">{{ $cashAdvance->particulars ?? 'N/A' }}</p>
                        </div>
                        <div class="mb-4">
                            <p class="text-sm">
                                <span class="font-medium text-white">PAP:</span>
                                <span class="text-gray-300">{{ $cashAdvance->pap ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <table class="w-full text-sm text-gray-300 table-fixed border-collapse mb-4">
                            <tbody>
                                <tr>
                                    <td class="font-medium text-white py-2 pr-4 w-1/3">Check Number</td>
                                    <td class="py-2 pr-4">{{ $cashAdvance->check_number ?? 'N/A' }}</td>
                                    <td class="py-2">{{ $cashAdvance->check_date ? \Carbon\Carbon::parse($cashAdvance->check_date)->format('m/d/Y') : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-medium text-white py-2 pr-4">DV Number</td>
                                    <td class="py-2 pr-4">{{ $cashAdvance->dv_number ?? 'N/A' }}</td>
                                    <td class="py-2">{{ $cashAdvance->dv_date ? \Carbon\Carbon::parse($cashAdvance->dv_date)->format('m/d/Y') : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-medium text-white py-2 pr-4">ORS Number</td>
                                    <td class="py-2 pr-4">{{ $cashAdvance->ors_number ?? 'N/A' }}</td>
                                    <td class="py-2">{{ $cashAdvance->ors_date ? \Carbon\Carbon::parse($cashAdvance->ors_date)->format('m/d/Y') : 'N/A' }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="space-y-2 text-sm text-white mt-4 border-t border-gray-600 pt-4">
                            <div class="flex justify-between">
                                <span class="font-semibold">Granted Amount:</span>
                                <span>₱{{ number_format($cashAdvance->granted_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right container: Liquidation Table -->
            <div x-data="{ showModal: false, deleteId: null }" class="w-full lg:w-2/3">
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 overflow-x-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Related Liquidations</h3>
            <div class="text-sm text-right space-y-1">
                <p class="text-gray-700 dark:text-gray-300">
                    <span class="font-semibold">Starting Balance:</span>
                    ₱{{ number_format($cashAdvance->granted_amount, 2) }}
                </p>
                <p class="text-gray-700 dark:text-gray-300">
                    <span class="font-semibold">Remaining Balance:</span>
                    ₱{{ number_format($cashAdvance->granted_amount - $liquidations->sum('liquidated_amount'), 2) }}
                </p>
            </div>
        </div>

        <!-- Sorting & Filtering -->
        <form method="GET" class="mb-4 flex flex-wrap items-center gap-4">
            <div>
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300 mr-2">Sort:</label>
                <select name="sort" onchange="this.form.submit()" class="bg-gray-100 dark:bg-gray-700 text-sm text-gray-800 dark:text-white rounded p-2">
                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Newest First</option>
                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Oldest First</option>
                </select>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300 mr-2">Filter:</label>
                <select name="type" onchange="this.form.submit()" class="bg-gray-100 dark:bg-gray-700 text-sm text-gray-800 dark:text-white rounded p-2">
                    <option value="">All</option>
                    <option value="Liquidation" {{ request('type') == 'Liquidation' ? 'selected' : '' }}>Liquidation</option>
                    <option value="Refund" {{ request('type') == 'Refund' ? 'selected' : '' }}>Refund</option>
                </select>
            </div>
        </form>

        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Type</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Grant Amount</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Liq Amount</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Liq Date Received</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Liq Number</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Liq Date</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">OR Number</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">OR Date</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Created At</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Actions</th>
                </tr>
            </thead>
            @if ($liquidations->isEmpty())
                <p class="text-gray-600 dark:text-gray-400">No liquidations found for this cash advance.</p>
            @else
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($liquidations as $liquidation)
                        <tr>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $liquidation->liquidation_type }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">₱{{ number_format($liquidation->granted_amount, 2) }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">₱{{ number_format($liquidation->liquidated_amount, 2) }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $liquidation->liq_date_received ? \Carbon\Carbon::parse($liquidation->liq_date_received)->format('F d, Y') : '—' }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $liquidation->liq_number ?? '—' }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $liquidation->liq_date ? \Carbon\Carbon::parse($liquidation->liq_date)->format('F d, Y') : '—' }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $liquidation->or_number ?? '—' }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $liquidation->or_date ? \Carbon\Carbon::parse($liquidation->or_date)->format('F d, Y') : '—' }}</td>
                            <td class="px-4 py-2 text-sm text-gray-500 dark:text-gray-400">{{ $liquidation->created_at->format('F d, Y') }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300 align-top">
                                <div class="flex flex-col items-start space-y-1">
                                    <a href="{{ route('liquidation.edit', $liquidation->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                    <button @click="showModal = true; deleteId = {{ $liquidation->id }}" class="text-red-600 hover:underline">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            @endif
        </table>

        <!-- Delete Confirmation Modal -->
        <div x-show="showModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white dark:bg-gray-900 rounded-lg p-6 w-full max-w-md shadow-lg">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Confirm Deletion</h2>
                <p class="text-gray-700 dark:text-gray-300 mb-6">Are you sure you want to delete this liquidation record? This action cannot be undone.</p>
                <div class="flex justify-end space-x-4">
                    <button @click="showModal = false" type="button" class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-white rounded">Cancel</button>
                    <form :action="`/liquidation/${deleteId}`" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

        </div>
    </div>
</x-app-layout>
