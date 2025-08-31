<div wire:poll.60s class="space-y-12 w-full px-2 sm:px-4 md:px-6 lg:px-8 xl:px-12">

    {{-- Section: Cash Advances --}}
    <h2 class="text-2xl font-semibold text-gray-100 mb-6">Cash Advances</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 w-full">
        @foreach($cashSummary as $label => $value)
            @php
                $labelLower = strtolower($label);
                $borderColor = match($labelLower) {
                    'overdue' => 'border-red-500',
                    'ongoing' => 'border-yellow-500',
                    'cancelled' => 'border-gray-400',
                    'fully liquidated' => 'border-green-500',
                    default => 'border-blue-500',
                };
            @endphp
            <div class="bg-gray-800 p-6 rounded-2xl shadow hover:shadow-lg transition-shadow border-l-4 {{ $borderColor }} flex flex-col justify-center items-center">
                <h3 class="text-gray-400 uppercase text-sm tracking-wider text-center">{{ ucwords(str_replace('_',' ',$label)) }}</h3>
                <p class="text-3xl font-extrabold text-white mt-2">{{ number_format(abs($value)) }}</p>
            </div>
        @endforeach
    </div>

    {{-- Section: Liquidation --}}
    <h2 class="text-2xl font-semibold text-gray-100 mt-12 mb-6">Liquidation</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6 w-full">
        @foreach(['total_for_liquidation', 'total_pre_audited', 'total_remaining'] as $key)
            <div class="bg-gray-800 p-6 rounded-2xl shadow border-t-4 border-green-500 flex flex-col justify-center items-center">
                <h4 class="text-gray-400 text-sm mb-2">
                    {{ ucwords(str_replace('_',' ',$key)) }}
                </h4>
                <p class="text-2xl font-bold text-white">{{ number_format(abs($liquidationSummary[$key]),2) }}</p>
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4 w-full">
        @foreach($liquidationSummary['statuses'] as $status => $amount)
            <div class="bg-gray-700 p-4 rounded-lg text-center shadow-sm flex flex-col justify-center items-center">
                <span class="text-gray-400 text-sm font-medium">{{ $status }}</span>
                <p class="text-xl font-semibold text-white mt-1">{{ number_format(abs($amount),2) }}</p>
            </div>
        @endforeach
    </div>

    {{-- Section: Bonded Officials / SDO --}}
    <h2 class="text-2xl font-semibold text-gray-100 mt-12 mb-6">Bonded Officials (SDO)</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full">
        <div class="bg-gray-800 p-6 rounded-2xl shadow border-l-4 border-indigo-500 hover:shadow-lg transition-shadow flex flex-col justify-center items-center">
            <h3 class="text-gray-400 text-sm uppercase tracking-wider text-center">With SO</h3>
            <p class="text-3xl font-extrabold text-white mt-2">{{ number_format(abs($bondedSummary['with_so'])) }}</p>
        </div>
        <div class="bg-gray-800 p-6 rounded-2xl shadow border-l-4 border-red-500 hover:shadow-lg transition-shadow flex flex-col justify-center items-center">
            <h3 class="text-gray-400 text-sm uppercase tracking-wider text-center">Without SO</h3>
            <p class="text-3xl font-extrabold text-white mt-2">{{ number_format(abs($bondedSummary['without_so'])) }}</p>
        </div>
    </div>

</div>
