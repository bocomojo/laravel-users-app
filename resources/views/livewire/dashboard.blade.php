<div wire:poll.60s class="space-y-12 w-full px-4 sm:px-6 lg:px-8">

    {{-- Date Filter --}}
    <div class="flex flex-col sm:flex-row gap-4 items-center mb-6">
        <div class="flex flex-col">
            <label for="start_date" class="text-sm font-medium text-gray-700 dark:text-gray-300">Start Date</label>
            <input type="date" id="start_date" wire:model="startDate" class="mt-1 p-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>
        <div class="flex flex-col">
            <label for="end_date" class="text-sm font-medium text-gray-700 dark:text-gray-300">End Date</label>
            <input type="date" id="end_date" wire:model="endDate" class="mt-1 p-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>
        <button wire:click="filterByDate" class="mt-4 sm:mt-6 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">Filter</button>
    </div>

    {{-- Section: Cash Advances --}}
    <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6">Cash Advances</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
        @foreach($cashSummary as $label => $value)
            @php
                $labelLower = strtolower($label);
                $bgColor = match($labelLower) {
                    'overdue' => 'bg-red-50 text-red-700 dark:bg-red-800 dark:text-red-300',
                    'ongoing' => 'bg-yellow-50 text-yellow-700 dark:bg-yellow-800 dark:text-yellow-300',
                    'cancelled' => 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300',
                    'fully liquidated' => 'bg-green-50 text-green-700 dark:bg-green-800 dark:text-green-300',
                    default => 'bg-blue-50 text-blue-700 dark:bg-blue-800 dark:text-blue-300',
                };
            @endphp
            <div class="p-6 rounded-2xl shadow hover:shadow-lg transition transform hover:-translate-y-1 {{ $bgColor }} flex flex-col justify-center items-center border-l-4 border-gray-300 dark:border-gray-600">
                <h3 class="text-sm font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">{{ ucwords(str_replace('_',' ',$label)) }}</h3>
                <p class="text-3xl font-extrabold mt-2">{{ number_format(abs($value)) }}</p>
            </div>
        @endforeach
    </div>

    {{-- Section: Liquidation --}}
    <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-12 mb-6">Liquidation</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        @foreach(['total_for_liquidation', 'total_pre_audited', 'total_remaining'] as $key)
            <div class="p-6 rounded-2xl shadow bg-white dark:bg-gray-800 flex flex-col justify-center items-center border-t-4 border-green-500 hover:shadow-lg transition transform hover:-translate-y-1">
                <h4 class="text-sm text-gray-400 dark:text-gray-300 mb-2">{{ ucwords(str_replace('_',' ',$key)) }}</h4>
                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ number_format(abs($liquidationSummary[$key]),2) }}</p>
            </div>
        @endforeach
    </div>

    {{-- Liquidation Statuses --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4 w-full">
        @php
            $statuses = $liquidationSummary['statuses'];

            // Define main status order
            $defaultStatuses = [
                'Draft' => 0,
                'For Checking' => 0,
                'Processing' => 0,
                'For Approval' => 0,
                'Approved' => 0,
                'For Transmittal' => 0,
                'Transmitted' => 0,
            ];

            // Merge with actual statuses
            $statuses = $defaultStatuses + $statuses;

            // Include other statuses not in default
            $otherStatuses = collect($statuses)->except(array_keys($defaultStatuses))->toArray();

            // Final ordered statuses
            $orderedStatuses = $defaultStatuses + $otherStatuses;
        @endphp

        @foreach($orderedStatuses as $status => $amount)
            <div class="p-4 rounded-xl shadow bg-white dark:bg-gray-800 flex flex-col justify-center items-center hover:shadow-md transition transform hover:-translate-y-0.5">
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $status }}</span>
                <p class="text-xl font-semibold text-gray-900 dark:text-gray-100 mt-1">{{ number_format(abs($amount),2) }}</p>
            </div>
        @endforeach
    </div>

    {{-- Section: Bonded Officials / SDO --}}
    <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-12 mb-6">Bonded Officials (SDO)</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="p-6 rounded-2xl shadow bg-white dark:bg-gray-800 flex flex-col justify-center items-center border-l-4 border-indigo-500 hover:shadow-lg transition transform hover:-translate-y-1">
            <h3 class="text-sm font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 text-center">With SO</h3>
            <p class="text-3xl font-extrabold text-gray-900 dark:text-gray-100 mt-2">{{ number_format(abs($bondedSummary['with_so'])) }}</p>
        </div>
        <div class="p-6 rounded-2xl shadow bg-white dark:bg-gray-800 flex flex-col justify-center items-center border-l-4 border-red-500 hover:shadow-lg transition transform hover:-translate-y-1">
            <h3 class="text-sm font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400 text-center">Without SO</h3>
            <p class="text-3xl font-extrabold text-gray-900 dark:text-gray-100 mt-2">{{ number_format(abs($bondedSummary['without_so'])) }}</p>
        </div>
    </div>

</div>
