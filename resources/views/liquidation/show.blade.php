<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cash Advance Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <!-- Return Button -->
        <div class="max-w-7xl mx-auto px-4 lg:px-8 mb-4 flex justify-end">
            <a href="{{ route('liquidation.index') }}"
            class="inline-block bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white px-4 py-2 rounded-md shadow hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                ← Return to Cash Advances
            </a>
        </div>
        <div class="flex flex-col lg:flex-row gap-6 max-w-7xl mx-auto px-4 lg:px-8">

            <!-- Left container: Cash Advance Summary -->
            <div class="w-full lg:w-1/3">
                <div class="bg-[#1f2937] text-white shadow-xl hover:shadow-2xl transition-shadow duration-300 rounded-xl p-6 space-y-6 border border-gray-700">
                    <!-- SDO Information -->
                    <div>
                        <h3 class="text-xl font-semibold mb-3 border-b border-gray-600 pb-2">SDO Information</h3>
                        <p class="text-sm text-gray-300 leading-relaxed">
                            <span class="font-medium text-white">Name:</span> {{ $cashAdvance->sdo->name ?? 'N/A' }}
                        </p>
                        <p class="text-sm text-gray-300 leading-relaxed">
                            <span class="font-medium text-white">SDO ID:</span> {{ $cashAdvance->sdo_id }}
                        </p>
                    </div>

                    <!-- Cash Advance Details -->
                    <div>
                        <h3 class="text-xl font-semibold mb-3 border-b border-gray-600 pb-2">Cash Advance Details</h3>
                        <p class="text-sm text-gray-300 leading-relaxed">
                            <span class="font-medium text-white">Check Number:</span> {{ $cashAdvance->check_number }}
                        </p>
                        <p class="text-sm text-gray-300 leading-relaxed">
                            <span class="font-medium text-white">Transaction Type:</span> {{ $cashAdvance->transaction_type }}
                        </p>
                        <p class="text-sm text-gray-300 leading-relaxed">
                            <span class="font-medium text-white">Granted Amount:</span> ₱{{ number_format($cashAdvance->granted_amount, 2) }}
                        </p>
                        <p class="text-sm text-gray-300 leading-relaxed">
                            <span class="font-medium text-white">Created At:</span> {{ $cashAdvance->created_at->format('F d, Y') }}
                        </p>
                    </div>
                </div>
            </div>


            <!-- Right container: Liquidation Table -->
            <div class="w-full lg:w-2/3">
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
        ₱{{ number_format(
            $cashAdvance->granted_amount - $liquidations->sum('liquidated_amount'),
        2) }}
    </p>
</div>

                        </div>

                        <form method="GET" class="mb-4 flex flex-wrap items-center gap-4">
                            <div>
                                <label class="text-sm font-medium text-gray-700 dark:text-gray-300 mr-2">Sort:</label>
                                <select name="sort" onchange="this.form.submit()" class="bg-gray-100 dark:bg-gray-700 text-sm text-gray-800 dark:text-white rounded p-2">
                                    <option value="desc" {{ $sortOrder == 'desc' ? 'selected' : '' }}>Newest First</option>
                                    <option value="asc" {{ $sortOrder == 'asc' ? 'selected' : '' }}>Oldest First</option>
                                </select>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-700 dark:text-gray-300 mr-2">Filter:</label>
                                <select name="type" onchange="this.form.submit()" class="bg-gray-100 dark:bg-gray-700 text-sm text-gray-800 dark:text-white rounded p-2">
                                    <option value="">All</option>
                                    <option value="Liquidation" {{ $filterType == 'Liquidation' ? 'selected' : '' }}>Liquidation</option>
                                    <option value="Refund" {{ $filterType == 'Refund' ? 'selected' : '' }}>Refund</option>
                                </select>
                            </div>
                        </form>
                    @if ($liquidations->isEmpty())
                        <p class="text-gray-600 dark:text-gray-400">No liquidations found for this cash advance.</p>
                    @else
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Type</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Granted Amount</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Liquidated Amount</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Created At</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($liquidations as $liquidation)
                                    <tr>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">{{ $liquidation->liquidation_type }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">₱{{ number_format($liquidation->granted_amount, 2) }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">₱{{ number_format($liquidation->liquidated_amount, 2) }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $liquidation->created_at->format('F d, Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
