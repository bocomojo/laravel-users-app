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

    <div class="py-6">
        <div class="mx-8">
            <div class="w-full px-4 mx-auto">
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-md overflow-hidden">

                    {{-- Filters --}}
                    <form method="GET" class="px-6 py-4 border-b dark:border-gray-700">
                        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">

                            <div class="flex flex-wrap gap-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type</label>
                                    <select name="type"
                                            class="mt-1 block w-36 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm">
                                        <option value="">All</option>
                                        <option value="Liquidation" {{ request('type') == 'Liquidation' ? 'selected' : '' }}>Liquidation</option>
                                        <option value="Refund" {{ request('type') == 'Refund' ? 'selected' : '' }}>Refund</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                    <select name="status"
                                            class="mt-1 block w-44 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm">
                                        <option value="">All</option>
                                        <option value="For Checking">For Checking</option>
                                        <option value="Processing">Processing</option>
                                        <option value="Approved">Approved</option>
                                        <option value="For Approval">For Approval</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Draft">Draft</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date From</label>
                                    <input type="date" name="date_from" value="{{ request('date_from') }}"
                                           class="mt-1 block w-36 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm" />
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date To</label>
                                    <input type="date" name="date_to" value="{{ request('date_to') }}"
                                           class="mt-1 block w-36 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm" />
                                </div>

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

                            <div class="relative w-full md:w-64">
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..."
                                       class="w-full pl-10 pr-4 py-2 rounded-md text-sm border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
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
                                    <th class="px-6 py-3">Liq Amount</th>
                                    <th class="px-6 py-3">For Compliance</th>
                                    <th class="px-6 py-3">Pre-Audited</th>
                                    <th class="px-6 py-3">Status</th>
                                    <th class="px-6 py-3">Type</th>
                                    <th class="px-6 py-3">Received</th>
                                    <th class="px-6 py-3">Reference</th>
                                    <th class="px-6 py-3">Reviewed Date</th>
                                    <th class="px-6 py-3 text-center">Entries</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($liquidations as $liq)
                                    <tr class="{{ $loop->odd ? 'bg-white dark:bg-gray-800' : 'bg-gray-50 dark:bg-gray-700' }} hover:bg-blue-50 dark:hover:bg-gray-600 transition">

                                        <td class="px-6 py-3">{{ $liq->sdo_name }}</td>

                                        <td class="px-6 py-3">
                                            <a href="{{ route('liquidation.show', $liq->cash_advance_id) }}"
                                               class="text-blue-600 hover:underline">
                                                {{ $liq->check_number }}
                                            </a>
                                        </td>

                                        <td class="px-6 py-3">
                                            ₱{{ number_format(abs($liq->for_liquidation_amount), 2) }}
                                        </td>

                                        <td class="px-6 py-3">
                                            ₱{{ number_format($liq->for_compliance_amount ?? 0, 2) }}
                                        </td>

                                        <td class="px-6 py-3">
                                            ₱{{ number_format($liq->pre_audited_amount ?? 0, 2) }}
                                        </td>

                                        <td class="px-6 py-3">
                                            @php
                                                $status = $liq->status;
                                                $statusStyles = [
                                                    'For Checking' => 'bg-yellow-200 text-yellow-800',
                                                    'Processing'   => 'bg-orange-200 text-orange-800',
                                                    'Approved'     => 'bg-green-100 text-green-800',
                                                    'For Approval' => 'bg-blue-200 text-blue-800',
                                                    'Completed'    => 'bg-gray-300 text-gray-900',
                                                    'Draft'        => 'bg-purple-200 text-purple-800',
                                                    'For Transmittal' => 'bg-indigo-200 text-indigo-800',
                                                    'Transmitted'  => 'bg-teal-200 text-teal-800',
                                                ];
                                            @endphp

                                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full {{ $statusStyles[$status] ?? 'bg-gray-100 text-gray-800' }}">
                                                {{ $status ?? '—' }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-3">{{ $liq->liquidation_type }}</td>

                                        <td class="px-6 py-3">{{ $liq->liq_date_received ?? '—' }}</td>

                                        <td class="px-6 py-3">
                                            {{ $liq->liq_number ?? $liq->or_number ?? '—' }}
                                        </td>

                                        <td class="px-6 py-3">
                                            {{ $liq->liq_date ?? $liq->or_date ?? '—' }}
                                        </td>

                                        <td class="px-6 py-3 text-center">
                                            <a href="{{ route('liquidation.pre-audits', $liq->id) }}"
   class="text-blue-600 hover:underline">
   View Pre-Audits
</a>

                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center px-6 py-6 text-gray-500">
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
        </div>
    </div>
</x-app-layout>
