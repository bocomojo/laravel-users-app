    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Cash Advances / Liquidation') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">SDO Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">PAP</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Check #</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Type</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Amount</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Remaining Balance</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Actions</th> <!-- New column -->
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                @foreach($cashAdvances as $advance)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $advance->sdo->name ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $advance->check_number }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $advance->transaction_type }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $advance->papData->pap_name}}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ number_format($advance->granted_amount, 2) }}</td>
                                        @php
                                            $totalLiquidated = $advance->liquidation->sum('liquidated_amount'); // adds all liquidation amounts
                                            $remainingBalance = $advance->granted_amount - $totalLiquidated;
                                        @endphp
                                        <td class="px-6 py-4 whitespace-nowrap">{{ number_format($remainingBalance, 2) }}</td>
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
                                                <a href="{{ route('liquidation.create', ['cash_advance_id' => $advance->id]) }}" class="inline-block px-3 py-1 text-sm text-white bg-green-600 rounded hover:bg-green-700">
                                                Add Liquidation
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @if($cashAdvances->isEmpty())
                            <p class="mt-4 text-center text-gray-500 dark:text-gray-400">No cash advances found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
