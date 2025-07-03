<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cash Advances for ') . $sdo->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Check #</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Remaining Balance</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @forelse($sdo->cashAdvances as $advance)
                                @php
                                    $totalLiquidated = $advance->liquidation->sum('liquidated_amount');
                                    $remainingBalance = $advance->granted_amount - $totalLiquidated;
                                @endphp
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $advance->check_number }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $advance->transaction_type }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($advance->granted_amount, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($remainingBalance, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $advance->created_at->format('Y-m-d') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                        <a href="{{ route('liquidation.show', $advance->id) }}" class="inline-block px-3 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600">
                                            View
                                        </a>
                                        @if ($remainingBalance == 0)
                                            <a href="{{ route('certificate.print', $advance->id) }}" target="_blank"
                                               class="inline-block px-3 py-1 text-sm text-white bg-purple-600 rounded hover:bg-purple-700">
                                                Print Certificate
                                            </a>
                                        @else
                                            <a href="{{ route('liquidation.create', ['cash_advance_id' => $advance->id]) }}"
                                               class="inline-block px-3 py-1 text-sm text-white bg-green-600 rounded hover:bg-green-700">
                                                Add Liquidation
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center px-6 py-4 text-gray-500 dark:text-gray-400">
                                        No cash advances found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
