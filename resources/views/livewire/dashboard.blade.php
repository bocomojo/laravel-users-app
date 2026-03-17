<div wire:poll.60s class="w-full max-w-[1700px] mx-auto px-12 py-12 space-y-14 bg-gray-100 dark:bg-gray-900">

@php

$cashCards = [
    ['Total', $cashSummary['total'], 'bg-blue-600'],
    ['Ongoing', $cashSummary['ongoing'], 'bg-yellow-600'],
    ['Overdue', $cashSummary['overdue'], 'bg-red-600'],
    ['Cancelled', $cashSummary['cancelled'], 'bg-gray-500'],
    ['Fully Liquidated', $cashSummary['fully_liquidated'], 'bg-indigo-600'],
];

$liquidationCards = [
    ['Total For Liquidation', abs($liquidationSummary['total_for_liquidation'])],
    ['Total Complied', abs($liquidationSummary['total_pre_audited'])],
    ['Total Remaining', max(0,$liquidationSummary['total_remaining'])],
];

@endphp


{{-- HEADER --}}
<div class="flex justify-between items-end border-b border-gray-300 dark:border-gray-700 pb-6">

    <div>
        <h1 class="text-3xl font-semibold text-gray-900 dark:text-gray-100">
            Accounting Financial Dashboard
        </h1>

        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
            Cash Advance and Liquidation Monitoring
        </p>
    </div>

    <div class="flex gap-4">

        <div>
            <label class="text-xs text-gray-500">Start Date</label>
            <input type="date"
                wire:model="startDate"
                class="mt-1 p-2 border rounded-md bg-white dark:bg-gray-800 dark:border-gray-600">
        </div>

        <div>
            <label class="text-xs text-gray-500">End Date</label>
            <input type="date"
                wire:model="endDate"
                class="mt-1 p-2 border rounded-md bg-white dark:bg-gray-800 dark:border-gray-600">
        </div>

        <button wire:click="filterByDate"
            class="px-6 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 self-end">
            Apply
        </button>

    </div>

</div>



{{-- CASH ADVANCES --}}
<section>

<h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-6">
Cash Advances
</h2>

<div class="grid grid-cols-2 md:grid-cols-5 gap-6">

@foreach($cashCards as [$label,$value,$color])

<div class="{{ $color }} text-white p-6 rounded-lg text-center shadow">

<p class="text-xs uppercase">{{ $label }}</p>

<p class="text-2xl font-bold mt-2">
{{ number_format($value) }}
</p>

</div>

@endforeach

</div>

</section>



{{-- LIQUIDATION --}}
<section>

<h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-6">
Liquidation
</h2>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

@foreach($liquidationCards as [$label,$value])

<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border-t-4 border-green-500 text-center">

<p class="text-xs uppercase text-gray-500">
{{ $label }}
</p>

<p class="text-2xl font-semibold mt-3">
₱ {{ number_format($value,2) }}
</p>

</div>

@endforeach

</div>

</section>



{{-- LIQUIDATION STATUS --}}
<section>

<div class="grid grid-cols-2 md:grid-cols-5 gap-6">

@foreach($liquidationSummary['statuses'] as $status => $amount)

<div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow-sm text-center">

<p class="text-xs uppercase text-gray-500">
{{ $status }}
</p>

<p class="text-lg font-semibold mt-2">
₱ {{ number_format(abs($amount),2) }}
</p>

</div>

@endforeach

</div>

</section>



{{-- BONDED OFFICIALS --}}
<section>

<h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-6">
Bonded Officials (SDO)
</h2>

<div class="grid grid-cols-2 gap-6 max-w-md">

<div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow-sm text-center border-l-4 border-blue-500">

<p class="text-xs uppercase text-gray-500">
With SO
</p>

<p class="text-2xl font-semibold mt-2">
{{ number_format($bondedSummary['with_so']) }}
</p>

</div>

<div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow-sm text-center border-l-4 border-red-500">

<p class="text-xs uppercase text-gray-500">
Without SO
</p>

<p class="text-2xl font-semibold mt-2">
{{ number_format($bondedSummary['without_so']) }}
</p>

</div>

</div>

</section>

</div>