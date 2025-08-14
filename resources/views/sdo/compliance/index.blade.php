<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Compliance Tracking') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <!-- Search + Filter -->
                <form method="GET" action="{{ route('sdo.compliance.index') }}" class="mb-6 flex flex-wrap items-center justify-between gap-4">

                    <!-- Left: Filters -->
                    <div class="flex items-center gap-2 flex-wrap">
                        <!-- Start Date -->
                        <input type="date" name="start_date" value="{{ request('start_date') }}"
                            class="border rounded px-3 py-2 dark:bg-gray-700 dark:text-gray-200">

                        <!-- End Date -->
                        <input type="date" name="end_date" value="{{ request('end_date') }}"
                            class="border rounded px-3 py-2 dark:bg-gray-700 dark:text-gray-200">

                        <!-- Filter Button -->
                        <button type="submit" name="action" value="filter"
                                class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-sm">
                            Filter
                        </button>

                        <!-- Clear Button -->
                        <a href="{{ route('sdo.compliance.index') }}" 
                        class="bg-gray-500 text-white px-3 py-1 rounded hover:bg-gray-600 text-sm">
                            Clear
                        </a>
                    </div>

                    <!-- Right: Search -->
                    <div class="flex items-center gap-2">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search SDO name or amount"
                            class="border rounded px-3 py-2 dark:bg-gray-700 dark:text-gray-200 w-64">

                        <!-- Search Button -->
                        <button type="submit" name="action" value="search"
                                class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 text-sm">
                            Search
                        </button>
                    </div>
                </form>

                @if ($liquidations->isEmpty())
                    <p class="text-gray-600 dark:text-gray-300">No liquidations found.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-700 dark:text-gray-200">
                                <tr>
                                    <th class="px-6 py-3">SDO Name</th>
                                    <th class="px-6 py-3">Liq Number</th>
                                    <th class="px-6 py-3">Liq Date</th>
                                    <th class="px-6 py-3">Compliance Amount</th>
                                    <th class="px-6 py-3">Compliance File</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                                @foreach ($liquidations as $liq)
                                    <tr>
                                        <td class="px-6 py-3 text-gray-800 dark:text-gray-100">
                                            {{ $liq->sdo_name ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-3 text-gray-800 dark:text-gray-100">
                                            {{ $liq->liq_number }}
                                        </td>
                                        <td class="px-6 py-3 text-gray-800 dark:text-gray-100">
                                            {{ \Carbon\Carbon::parse($liq->liq_date)->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-3 text-gray-800 dark:text-gray-100">
                                            {{ number_format($liq->preAuditEntries->first()->for_compliance ?? 0, 2) }}
                                        </td>
                                        <td class="px-6 py-3 text-gray-800 dark:text-gray-100">
                                            @php
                                                $file = $liq->preAuditEntries->first()->compliance_file ?? null;
                                            @endphp
                                            @if ($file)
                                                <a href="{{ asset('storage/' . $file) }}" 
                                                   target="_blank" 
                                                   class="underline text-blue-600 dark:text-blue-400">
                                                    View File
                                                </a>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
