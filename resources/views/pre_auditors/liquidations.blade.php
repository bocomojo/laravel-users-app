<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Liquidations for {{ $auditor->name }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                @if($liquidations->count())
                    <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-xs font-semibold">
                            <tr>
                                <th class="px-4 py-2">Liquidation Number</th>
                                <th class="px-4 py-2">SDO</th>
                                <th class="px-4 py-2">Check #</th>
                                <th class="px-4 py-2">Type</th>
                                <th class="px-4 py-2">Liq Amount</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Date Received</th>
                                <th class="px-4 py-2 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($liquidations as $liq)
                                <tr class="border-t border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-4 py-2">{{ $liq->liq_number ?? '—' }}</td>
                                    <td class="px-4 py-2">{{ $liq->sdo_name }}</td>
                                    <td class="px-4 py-2">{{ $liq->check_number }}</td>
                                    <td class="px-4 py-2">{{ $liq->liquidation_type }}</td>
                                    <td class="px-4 py-2">₱{{ number_format($liq->for_liquidation_amount, 2) }}</td>
                                    <td class="px-4 py-2">{{ $liq->status ?? '—' }}</td>
                                    <td class="px-4 py-2">{{ $liq->liq_date_received ?? '—' }}</td>
                                    <td class="px-4 py-2 text-center">
                                        @if($liq->status !== 'Completed')
                                            <form method="POST" action="{{ route('liquidation.complete', $liq->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white text-xs px-3 py-1 rounded">
                                                    Complete
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-green-500 text-xs font-semibold">Completed</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $liquidations->links() }}
                    </div>
                @else
                    <p class="text-gray-500 dark:text-gray-400">No liquidations assigned to this auditor.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
