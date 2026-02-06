<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('For Transmittal Liquidations') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Success Message --}}
            @if(session('success'))
                <div class="p-4 bg-green-100 dark:bg-green-200 text-green-800 dark:text-green-900 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Top Bar --}}
            <div 
                x-data="{ open: false, liqIds: @json($liquidations->pluck('id')) }"
                class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6"
            >
                {{-- Left: Action Buttons --}}
                <div class="flex gap-2">
                    <a href="{{ route('liquidation.export.transmittal') }}"
                       class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow text-sm">
                        Export
                    </a>
                    <a href="{{ route('liquidation.assign.sack') }}"
                       class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow text-sm">
                        Assign Sack #
                    </a>

                    {{-- Transmit Modal Trigger --}}
                    <form method="POST" action="{{ route('liquidation.transmit.bulk') }}">
                        @csrf

                        <!-- Hidden inputs for all visible liquidation IDs -->
                        <template x-for="id in liqIds" :key="id">
                            <input type="hidden" name="liq_ids[]" :value="id">
                        </template>

                        <button type="button"
                            @click="open = true"
                            class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded shadow text-sm">
                            Transmit
                        </button>

                        <!-- Modal -->
                        <div
                            x-show="open"
                            x-cloak
                            class="fixed inset-0 flex items-center justify-center bg-black/50 z-50"
                            x-transition.opacity
                        >
                            <div
                                class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-md w-full mx-4 p-6 transform transition-all"
                                x-transition.scale
                                @click.outside="open = false"
                            >
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">
                                    Confirm Transmittal
                                </h2>
                                <p class="text-gray-700 dark:text-gray-300 mb-6">
                                    Are you sure you want to mark
                                    <strong>ALL</strong> shown liquidations as
                                    <span class="font-semibold text-purple-600">Transmitted</span>?
                                    <br>This action cannot be undone.
                                </p>

                                <div class="flex justify-end gap-3">
                                    <button type="button"
                                        @click="open = false"
                                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded hover:bg-gray-300 dark:hover:bg-gray-600">
                                        Cancel
                                    </button>
                                    <button type="submit"
                                        class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded shadow">
                                        Yes, Transmit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Right: Search Form --}}
                <form method="GET" action="{{ url()->current() }}" class="flex gap-2 w-full md:w-auto">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="w-full md:w-64 px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded shadow-sm focus:outline-none focus:ring focus:ring-blue-500"
                        placeholder="Search LR number or SDO name...">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow text-sm">
                        Search
                    </button>
                </form>
            </div>

            {{-- Table --}}
            @if($liquidations->isEmpty())
                <p class="text-gray-600 dark:text-gray-300 text-center">No liquidations found for transmittal.</p>
            @else
                <div class="overflow-x-auto rounded shadow border border-gray-200 dark:border-gray-700">
                    <table class="min-w-full text-sm text-left text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-900">
                        <thead class="bg-gray-100 dark:bg-gray-800 border-b border-gray-300 dark:border-gray-700">
                            <tr>
                                <th class="px-4 py-3">SDO</th>
                                <th class="px-4 py-3">LR Number</th>
                                <th class="px-4 py-3 text-right">Amount</th>
                                <th class="px-4 py-3 text-right">Pre-Audited</th>
                                <th class="px-4 py-3">JEV No</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Sack No.</th>
                                <th class="px-4 py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($liquidations as $liq)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                    <td class="px-4 py-2">{{ $liq->sdo_name ?? '—' }}</td>
                                    <td class="px-4 py-2">{{ $liq->liq_number }}</td>
                                    <td class="px-4 py-2 text-right">{{ number_format(abs($liq->for_liquidation_amount), 2) }}</td>
                                    <td class="px-4 py-2 text-right">{{ number_format($liq->pre_audited_amount, 2) }}</td>
                                    <td class="px-4 py-2">{{ $liq->jev_no }}</td>
                                    <td class="px-4 py-2">{{ $liq->status ?? '—' }}</td>
                                    <td class="px-4 py-2">{{ $liq->sack_no ?? '—' }}</td>
                                    <td class="px-4 py-2 text-center">
                                        <a href="{{ route('liquidation.show', $liq->cash_advance_id) }}"
                                           class="text-blue-600 hover:underline dark:text-blue-400">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
