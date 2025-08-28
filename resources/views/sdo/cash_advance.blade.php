<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ $sdo->name }} - Cash Advances
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-md sm:rounded-lg p-6">

                {{-- Filters & Search --}}
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
                    
                    {{-- Left: Filters --}}
                    <form method="GET" class="flex flex-wrap items-center gap-2">
                        <select name="status"
                            class="border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 rounded-md text-sm px-2 py-1 focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Status --</option>
                            <option value="Draft" {{ request('status')=='Draft' ? 'selected' : '' }}>Draft</option>
                            <option value="Approved" {{ request('status')=='Approved' ? 'selected' : '' }}>Approved</option>
                            <option value="Cancelled" {{ request('status')=='Cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>

                        <input type="date" name="payout_start" value="{{ request('payout_start') }}"
                               class="border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 rounded-md text-sm px-2 py-1 focus:ring-2 focus:ring-blue-500">
                        
                        <input type="date" name="payout_end" value="{{ request('payout_end') }}"
                               class="border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 rounded-md text-sm px-2 py-1 focus:ring-2 focus:ring-blue-500">

                        <button type="submit"
                            class="px-3 py-1 bg-blue-600 text-white text-xs rounded-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-400">
                            Apply
                        </button>

                        <a href="{{ route('sdo.cash_advances', $sdo->id) }}" 
                           class="px-3 py-1 bg-gray-500 text-white text-xs rounded-md hover:bg-gray-600 focus:ring-2 focus:ring-gray-400">
                            Clear
                        </a>
                    </form>

                    {{-- Right: Search --}}
                    <form method="GET" class="flex">
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Search name, check #, DV #, ORS #"
                               class="w-64 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 rounded-md text-sm px-2 py-1 focus:ring-2 focus:ring-green-500">
                        <button type="submit"
                            class="ml-2 px-3 py-1 bg-green-600 text-white text-xs rounded-md hover:bg-green-700 focus:ring-2 focus:ring-green-400">
                            Search
                        </button>
                    </form>
                </div>

                {{-- Table --}}
                <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
                    <table class="w-full table-auto text-sm">
                        <thead class="bg-gray-100 dark:bg-gray-800">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300 uppercase">Check #</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300 uppercase">Check Date</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300 uppercase">DV #</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300 uppercase">DV Date</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300 uppercase">ORS #</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300 uppercase">ORS Date</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300 uppercase">Particulars</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300 uppercase">Transaction Type</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300 uppercase">PAP</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300 uppercase">Granted Amount</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300 uppercase">Payout Start</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300 uppercase">Payout End</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($sdo->cashAdvances as $ca)
                                <tr onclick="window.location='{{ route('liquidation.show', $ca->id) }}'"
                                    class="cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                    <td class="px-4 py-3 text-gray-900 dark:text-gray-100">{{ $ca->check_number }}</td>
                                    <td class="px-4 py-3 text-gray-900 dark:text-gray-100">{{ $ca->check_date }}</td>
                                    <td class="px-4 py-3 text-gray-900 dark:text-gray-100">{{ $ca->dv_number }}</td>
                                    <td class="px-4 py-3 text-gray-900 dark:text-gray-100">{{ $ca->dv_date }}</td>
                                    <td class="px-4 py-3 text-gray-900 dark:text-gray-100">{{ $ca->ors_number }}</td>
                                    <td class="px-4 py-3 text-gray-900 dark:text-gray-100">{{ $ca->ors_date }}</td>
                                    <td class="px-4 py-3 text-gray-900 dark:text-gray-100">{{ $ca->particulars }}</td>
                                    <td class="px-4 py-3 text-gray-900 dark:text-gray-100">{{ $ca->transaction_type }}</td>
                                    <td class="px-4 py-3 text-gray-900 dark:text-gray-100">{{ $ca->pap }}</td>
                                    <td class="px-4 py-3 text-gray-900 dark:text-gray-100">{{ number_format($ca->granted_amount, 2) }}</td>
                                    <td class="px-4 py-3 text-gray-900 dark:text-gray-100">{{ $ca->payout_start }}</td>
                                    <td class="px-4 py-3 text-gray-900 dark:text-gray-100">{{ $ca->payout_end }}</td>
                                    <td class="px-4 py-3 text-gray-900 dark:text-gray-100">{{ $ca->status }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="13" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
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
