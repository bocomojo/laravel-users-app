<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Liquidation Records') }}
        </h2>
    </x-slot>

    {{-- Floating Add Button --}}
    <a href="{{ route('liquidation.create') }}"
       class="fixed bottom-6 right-6 bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-full shadow-lg z-50"
       title="Add Liquidation">
        <svg class="w-5 h-5 inline-block" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
    </a>

    <div class="py-6" x-data="{ openExportModal: false }">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-md overflow-hidden">

                {{-- Export Button above filters --}}
                <div class="px-6 pt-6 flex justify-end">
                    <button type="button" @click="openExportModal = true"
                            class="bg-green-600 hover:bg-green-700 text-white text-sm px-4 py-2 rounded-md">
                        Export
                    </button>
                </div>

                {{-- Filters & Search --}}
                <form method="GET" class="px-6 py-4 border-b dark:border-gray-700">
                    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                        <div class="flex flex-wrap gap-3">
                            {{-- Type Filter --}}
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type</label>
                                <select name="type" id="type"
                                        class="mt-1 block w-36 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm">
                                    <option value="">All</option>
                                    <option value="Liquidation" {{ request('type') == 'Liquidation' ? 'selected' : '' }}>Liquidation</option>
                                    <option value="Refund" {{ request('type') == 'Refund' ? 'selected' : '' }}>Refund</option>
                                </select>
                            </div>

                            {{-- Date From --}}
                            <div>
                                <label for="date_from" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date From</label>
                                <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}"
                                       class="mt-1 block w-36 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm" />
                            </div>

                            {{-- Date To --}}
                            <div>
                                <label for="date_to" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date To</label>
                                <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}"
                                       class="mt-1 block w-36 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm" />
                            </div>

                            {{-- Apply + Clear --}}
                            <div class="mt-auto flex gap-2">
                                <button type="submit"
                                        class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-md">
                                    Apply
                                </button>
                                <a href="{{ route('liquidation.index') }}"
                                   class="bg-gray-300 hover:bg-gray-400 dark:bg-gray-600 dark:hover:bg-gray-500 text-gray-800 dark:text-white text-sm px-4 py-2 rounded-md">
                                    Clear
                                </a>
                            </div>
                        </div>

                        {{-- Search --}}
                        <div class="relative w-full md:w-64">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..."
                                   class="w-full pl-10 pr-4 py-2 rounded-md text-sm border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </form>

                {{-- Table --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
                        <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700 font-semibold">
                            <tr>
                                <th class="px-6 py-3">SDO</th>
                                <th class="px-6 py-3">Check #</th>
                                <th class="px-6 py-3">Granted</th>
                                <th class="px-6 py-3">Liquidated</th>
                                <th class="px-6 py-3">Type</th>
                                <th class="px-6 py-3">Received</th>
                                <th class="px-6 py-3">Reference (LR/OR)</th>
                                <th class="px-6 py-3">LR/OR Date</th>
                                <th class="px-6 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($liquidations as $liq)
                                <tr class="{{ $loop->odd ? 'bg-white dark:bg-gray-800' : 'bg-gray-50 dark:bg-gray-700' }} hover:bg-blue-50 dark:hover:bg-gray-600 transition">
                                    <td class="px-6 py-3">{{ $liq->sdo_name }}</td>
                                    <td class="px-6 py-3">
                                        <a href="{{ route('liquidation.show', $liq->cash_advance_id) }}" class="text-blue-600 hover:underline">
                                            {{ $liq->check_number }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-3">₱{{ number_format($liq->granted_amount, 2) }}</td>
                                    <td class="px-6 py-3">₱{{ number_format($liq->for_liquidation_amount, 2) }}</td>
                                    <td class="px-6 py-3">{{ $liq->liquidation_type }}</td>
                                    <td class="px-6 py-3">{{ $liq->liq_date_received ?? '—' }}</td>

                                    {{-- Reference: OR or LR --}}
                                    <td class="px-6 py-3">
                                        @if ($liq->liquidation_type === 'Refund')
                                            {{ $liq->or_number ?? '—' }}
                                        @elseif ($liq->liquidation_type === 'Liquidation')
                                            {{ $liq->liq_number ?? '—' }}
                                        @else
                                            —
                                        @endif
                                    </td>

                                    {{-- LR/OR Date --}}
                                    <td class="px-6 py-3">
                                        @if ($liq->liquidation_type === 'Refund')
                                            {{ $liq->or_date ? \Carbon\Carbon::parse($liq->or_date)->format('F d, Y') : '—' }}
                                        @elseif ($liq->liquidation_type === 'Liquidation')
                                            {{ $liq->liq_date ? \Carbon\Carbon::parse($liq->liq_date)->format('F d, Y') : '—' }}
                                        @else
                                            —
                                        @endif
                                    </td>

                                    {{-- Actions --}}
                                    <td class="px-6 py-3 text-center">
                                        <a href="{{ route('liquidation.edit', $liq->id) }}"
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center px-6 py-6 text-gray-500 dark:text-gray-400">
                                        No liquidation records found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="px-6 py-4">
                    {{ $liquidations->links() }}
                </div>
            </div>
        </div>

        {{-- Export Modal --}}
        <div x-show="openExportModal" x-cloak class="fixed inset-0 flex items-center justify-center z-50">
            <div class="fixed inset-0 bg-black bg-opacity-50" @click="openExportModal = false"></div>
            <form method="GET" action="{{ route('liquidation.condensed.export') }}"
                class="bg-white dark:bg-gray-800 p-6 rounded-md shadow-md w-full max-w-lg z-50 space-y-4">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Condensed Export Filters</h2>

                {{-- Liquidation Date Range --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm text-gray-700 dark:text-gray-300">Liq Date From</label>
                        <input type="date" name="liq_date_from"
                            class="mt-1 block w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm">
                    </div>
                    <div>
                        <label class="text-sm text-gray-700 dark:text-gray-300">Liq Date To</label>
                        <input type="date" name="liq_date_to"
                            class="mt-1 block w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm">
                    </div>
                </div>

                {{-- Received Date Range --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm text-gray-700 dark:text-gray-300">Received Date From</label>
                        <input type="date" name="received_date_from"
                            class="mt-1 block w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm">
                    </div>
                    <div>
                        <label class="text-sm text-gray-700 dark:text-gray-300">Received Date To</label>
                        <input type="date" name="received_date_to"
                            class="mt-1 block w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm">
                    </div>
                </div>

                {{-- Type --}}
                <div>
                    <label class="text-sm text-gray-700 dark:text-gray-300">Type</label>
                    <select name="type"
                            class="mt-1 block w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm">
                        <option value="">All</option>
                        <option value="Liquidation">Liquidation</option>
                        <option value="Refund">Refund</option>
                    </select>
                </div>

                {{-- SDO Name --}}
                <div>
                    <label class="text-sm text-gray-700 dark:text-gray-300">SDO Name</label>
                    <select name="sdo_name"
                            class="mt-1 block w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm">
                        <option value="">All</option>
                        @foreach($sdos as $sdo)
                            <option value="{{ $sdo->name }}">{{ $sdo->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Number --}}
                <div>
                    <label class="text-sm text-gray-700 dark:text-gray-300">Check or Liq Number</label>
                    <input type="text" name="number"
                        class="mt-1 block w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm">
                </div>

                {{-- Actions --}}
                <div class="flex justify-end gap-2">
                    <button type="button" @click="openExportModal = false"
                            class="px-4 py-2 text-sm bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-white rounded">
                        Cancel
                    </button>
                    <button type="submit"
                            class="px-4 py-2 text-sm bg-green-600 hover:bg-green-700 text-white rounded">
                        Export
                    </button>
                </div>
            </form>
        </div>

    </div>
</x-app-layout>
