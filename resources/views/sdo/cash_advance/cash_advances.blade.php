<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cash Advances / Liquidation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-10 lg:px-16">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-x-auto">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Filter Form --}}
                    <form method="GET" class="mb-4 flex flex-wrap items-center gap-4">
                        {{-- Status Filter --}}
                        <select name="status"
                            class="px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-sm">
                            <option value="">All Status</option>
                            <option value="Fully Liquidated" {{ request('status') == 'Fully Liquidated' ? 'selected' : '' }}>
                                Fully Liquidated
                            </option>
                            <option value="Ongoing" {{ request('status') == 'Ongoing' ? 'selected' : '' }}>
                                Ongoing
                            </option>
                        </select>

                        {{-- PAP Filter --}}
                        <select name="pap"
                            class="px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-sm">
                            <option value="">All PAP</option>
                            @foreach($paps as $pap)
                                <option value="{{ $pap->pap_name }}" {{ request('pap') == $pap->pap_name ? 'selected' : '' }}>
                                    {{ $pap->pap_name }}
                                </option>
                            @endforeach
                        </select>

                        <!-- {{-- Demand Letter Status Filter --}}
                        <select name="demand_letter_status"
                            class="px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-sm">
                            <option value="">All Demand Letter Status</option>
                            <option value="Overdue" {{ request('demand_letter_status') == 'Overdue' ? 'selected' : '' }}>
                                Overdue
                            </option>
                        </select> -->

                        {{-- Filter Button --}}
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 text-sm">
                            Filter
                        </button>

                        {{-- Clear Filter --}}
                        <a href="{{ route('sdo.cash_advance.cash_advances') }}"
                            class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-400 text-sm">
                            Clear
                        </a>

                        {{-- Search Field Floated Right --}}
                        <div class="ml-auto">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Search SDO, PAP, or Check #"
                                class="px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-sm">
                        </div>
                    </form>

                    {{-- Table --}}
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left font-semibold uppercase tracking-wider">SDO Name</th>
                                <th class="px-6 py-3 text-left font-semibold uppercase tracking-wider">PAP</th>
                                <th class="px-6 py-3 text-left font-semibold uppercase tracking-wider">Check #</th>
                                <th class="px-6 py-3 text-left font-semibold uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left font-semibold uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 text-left font-semibold uppercase tracking-wider">Remaining Balance</th>
                                <th class="px-6 py-3 text-left font-semibold uppercase tracking-wider">Cash Advance Status</th>
                                <th class="px-6 py-3 text-left font-semibold uppercase tracking-wider">Actions</th>
                                <th class="px-6 py-3 text-left font-semibold uppercase tracking-wider">Demand Letter Status</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($cashAdvances as $advance)
                                @php
                                    // Deduct pre-audited and refunded liquidation amounts
                                    $relatedLiquidations = $advance->liquidation->where('status', 'Approved');
                                    $preAudited = $relatedLiquidations->sum('pre_audited_amount');
                                    $refunds = $advance->liquidation->where('liquidation_type', 'Refund')->sum('for_liquidation_amount');

                                    $remainingBalance = $advance->granted_amount - $preAudited + $refunds;

                                    // Determine cash advance status
                                    $now = \Carbon\Carbon::now();
                                    $cashAdvanceStatus = 'Ongoing';
                                    $agingDate = null;

                                    if ($remainingBalance <= 0) {
                                        $cashAdvanceStatus = 'Fully Liquidated';
                                    } elseif ($advance->payout_end) {
                                        $deadline = \Carbon\Carbon::parse($advance->payout_end)->addDays(31);
                                        if ($now->greaterThan($deadline)) {
                                            $cashAdvanceStatus = 'Overdue';
                                            $agingDate = $deadline;
                                        } else {
                                            $agingDate = $deadline;
                                        }
                                    }

                                    $badgeColor = match($cashAdvanceStatus) {
                                        'Fully Liquidated' => 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100',
                                        'Overdue' => 'bg-red-100 text-red-800 dark:bg-red-700 dark:text-red-100',
                                        default => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-700 dark:text-yellow-100',
                                    };
                                @endphp

                                <tr>
                                    <td class="px-6 py-4">{{ $advance->sdo->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4">{{ $advance->papData->pap_name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4">{{ $advance->check_number }}</td>
                                    <td class="px-6 py-4">{{ $advance->transaction_type }}</td>
                                    <td class="px-6 py-4">₱{{ number_format($advance->granted_amount, 2) }}</td>
                                    <td class="px-6 py-4">₱{{ number_format($remainingBalance, 2) }}</td>

                                    {{-- Cash Advance Status --}}
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-block px-2 py-1 text-xs font-semibold rounded {{ $badgeColor }}">
                                            {{ $cashAdvanceStatus }}
                                        </span>
                                        @if($agingDate)
                                            <br>
                                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $now->diffForHumans($agingDate, ['parts' => 2, 'short' => true]) }}
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Actions --}}
                                    <td class="px-6 py-4 space-y-2">
                                        <a href="{{ route('liquidation.show', $advance->id) }}"
                                            class="block px-3 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600 text-center">
                                            View
                                        </a>
                                        <a href="{{ route('sdo.cash_advance.edit', ['id' => $advance->id]) }}"
                                            class="block px-3 py-1 text-sm text-white bg-yellow-500 rounded hover:bg-yellow-600 text-center">
                                            Edit
                                        </a>
                                        @if ($remainingBalance <= 0)
                                            <a href="{{ route('certificate.print', $advance->id) }}" target="_blank"
                                                class="block px-3 py-1 text-sm text-white bg-purple-600 rounded hover:bg-purple-700 text-center">
                                                Print Certificate
                                            </a>
                                        @else
                                            <a href="{{ route('liquidation.create', ['cash_advance_id' => $advance->id]) }}"
                                                class="block px-3 py-1 text-sm text-white bg-green-600 rounded hover:bg-green-700 text-center">
                                                Add Liquidation
                                            </a>
                                        @endif
                                    </td>

                                    {{-- Demand Letter Status --}}
                                    <td class="px-6 py-4">
                                        @if ($advance->demand_letter_sent_at)
                                            <span class="inline-block px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded dark:bg-green-800 dark:text-green-100">
                                                Sent
                                            </span>
                                            <br>
                                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ \Carbon\Carbon::parse($advance->demand_letter_sent_at)->diffForHumans() }}
                                            </span>
                                        @elseif ($remainingBalance <= 0)
                                            <span class="inline-block px-2 py-1 text-xs font-semibold bg-gray-200 text-gray-800 rounded dark:bg-gray-700 dark:text-gray-100">
                                                Not Needed
                                            </span>
                                        @else
                                            <span class="inline-block px-2 py-1 text-xs font-semibold bg-yellow-100 text-yellow-800 rounded dark:bg-yellow-700 dark:text-yellow-100">
                                                Pending
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                        No cash advances found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $cashAdvances->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
