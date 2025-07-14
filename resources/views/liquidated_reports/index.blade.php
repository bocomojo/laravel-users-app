<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Liquidated Reports') }}
        </h2>
    </x-slot>

    {{-- Floating Add Button --}}
    <a href="{{ route('liquidated_reports.create') }}"
       class="fixed bottom-6 right-6 bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-full shadow-lg z-50"
       title="Add Liquidated Report">
        <svg class="w-5 h-5 inline-block" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
    </a>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-md overflow-hidden">
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
                                <th class="px-6 py-3">Reference</th>
                                <th class="px-6 py-3">Ref Date</th>
                                <th class="px-6 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reports as $report)
                                <tr class="{{ $loop->odd ? 'bg-white dark:bg-gray-800' : 'bg-gray-50 dark:bg-gray-700' }} hover:bg-blue-50 dark:hover:bg-gray-600 transition">
                                    <td class="px-6 py-3">{{ $report->sdo_name }}</td>
                                    <td class="px-6 py-3">{{ $report->check_number }}</td>
                                    <td class="px-6 py-3">{{ number_format($report->granted_amount, 2) }}</td>
                                    <td class="px-6 py-3">{{ number_format($report->pre_audited_amount, 2) }}</td>
                                    <td class="px-6 py-3">{{ $report->liquidation_type }}</td>
                                    <td class="px-6 py-3">{{ $report->liq_date_received ?? '—' }}</td>
                                    <td class="px-6 py-3">
                                        @if ($report->liquidation_type === 'Refund')
                                            {{ $report->or_number ?? '—' }}
                                        @else
                                            {{ $report->liq_number ?? '—' }}
                                        @endif
                                    </td>
                                    <td class="px-6 py-3">
                                        @if ($report->liquidation_type === 'Refund')
                                            {{ $report->or_date ? \Carbon\Carbon::parse($report->or_date)->format('F d, Y') : '—' }}
                                        @else
                                            {{ $report->liq_date ? \Carbon\Carbon::parse($report->liq_date)->format('F d, Y') : '—' }}
                                        @endif
                                    </td>
                                    <td class="px-6 py-3 text-center">
                                        <a href="{{ route('liquidated_reports.edit', $report->id) }}"
                                           class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center px-6 py-6 text-gray-500 dark:text-gray-400">
                                        No liquidated reports found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4">
                    {{ $reports->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
