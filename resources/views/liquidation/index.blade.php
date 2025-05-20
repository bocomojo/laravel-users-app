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
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">SDO ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Check #</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @foreach($cashAdvances as $advance)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $advance->sdo_id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $advance->check_number }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $advance->transaction_type }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($advance->granted_amount, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $advance->created_at->format('Y-m-d') }}</td>
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
