<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
        Pre-Audit Entries — {{ $liquidation->liq_number ?? $liquidation->check_number }}
    </h2>
</x-slot>

<div x-data class="py-6 px-6 text-gray-800 dark:text-gray-200">

    <!-- Back Button -->
    <div class="flex justify-end mb-4">
        <a href="{{ route('liquidation.index') }}"
           class="bg-gray-200 hover:bg-gray-300 
                  dark:bg-gray-700 dark:hover:bg-gray-600 
                  text-gray-800 dark:text-gray-100 
                  px-4 py-2 rounded text-sm transition">
            ← Return
        </a>
    </div>

    <!-- Liquidation Row -->
    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden mb-6">

        <table class="w-full text-sm text-left">
            <thead class="bg-gray-100 dark:bg-gray-800 border-b border-gray-300 dark:border-gray-700">
                <tr class="text-gray-700 dark:text-gray-200">
                    <th class="px-4 py-2">SDO</th>
                    <th class="px-4 py-2">Check #</th>
                    <th class="px-4 py-2">Liq Amount</th>
                    <th class="px-4 py-2">For Compliance</th>
                    <th class="px-4 py-2">Complied</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Type</th>
                    <th class="px-4 py-2">Received</th>
                    <th class="px-4 py-2">Reference</th>
                    <th class="px-4 py-2 text-center">Action</th>
                </tr>
            </thead>

            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                @php $liq = $liquidation; @endphp
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">

                    <td class="px-4 py-3">{{ $liq->sdo_name }}</td>
                    <td class="px-4 py-3 text-blue-600 dark:text-blue-400 font-medium">
                        {{ $liq->check_number }}
                    </td>
                    <td class="px-4 py-3">
                        ₱{{ number_format(abs($liq->for_liquidation_amount),2) }}
                    </td>
                    <td class="px-4 py-3">
                        ₱{{ number_format($liq->for_compliance_amount ?? 0,2) }}
                    </td>
                    <td class="px-4 py-3">
                        ₱{{ number_format($liq->pre_audited_amount ?? 0,2) }}
                    </td>

                    <td class="px-4 py-3">
                        <span class="px-2 py-1 text-xs font-semibold rounded bg-gray-200 dark:bg-gray-600">
                            {{ $liq->status }}
                        </span>
                    </td>

                    <td class="px-4 py-3">{{ $liq->liquidation_type }}</td>
                    <td class="px-4 py-3">{{ $liq->liq_date_received ?? '—' }}</td>
                    <td class="px-4 py-3">{{ $liq->liq_number ?? $liq->or_number }}</td>

                    <td class="px-4 py-3 text-center">
                        <div class="flex justify-center gap-2 flex-wrap">

                            @if (in_array($liq->status, ['For Checking','Processing','For Approval']))
                            <button 
                                @click="window.dispatchEvent(
                                    new CustomEvent('open-preaudit-modal', {
                                        detail: { id: '{{ $liq->id }}' }
                                    })
                                )"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs">
                                Add Pre-Audit
                            </button>
                                @role('admin')
                                <form action="{{ route('liquidation.set-draft', $liq->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1 rounded text-xs">
                                        Set as Draft
                                    </button>
                                </form>
                                @endrole
                            @endif

                            @if ($liq->status === 'Draft')

                                <!-- EDIT LIQUIDATION (MAIN ROW) -->
                                <a href="{{ route('liquidation.edit', $liq->id) }}"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs">
                                    Edit
                                </a>

                                <!-- MARK AS DONE -->
                                <form action="{{ route('liquidation.markForApproval', $liq->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            class="bg-purple-600 hover:bg-purple-700 text-white px-3 py-1 rounded text-xs">
                                        Done
                                    </button>
                                </form>

                            @endif

                            @role('admin')
                                @if ($liq->status === 'For Approval')
                                    <form action="{{ route('liquidation.approve', $liq->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs">
                                            Approve
                                        </button>
                                    </form>
                                @endif
                            @endrole

                        </div>
                    </td>

                </tr>
            </tbody>
        </table>
    </div>


    <!-- Entries + History -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

        <!-- Entries Table -->
        <div class="lg:col-span-3 bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">

    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
        <h3 class="text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
            Pre-Audit Entries
        </h3>
    </div>

    @php
        $liqAmount = abs($liquidation->for_liquidation_amount);
        $runningBalance = $liqAmount;
    @endphp

    <div class="overflow-x-auto">
        <table class="w-full text-sm border-separate border-spacing-0">

            <thead class="bg-gray-50 dark:bg-gray-800 text-gray-600 dark:text-gray-300 uppercase text-xs tracking-wider">
                <tr>
                    <th class="px-6 py-3 text-left">Date</th>
                    <th class="px-6 py-3 text-left">Description</th>
                    <th class="px-6 py-3 text-right">Pre-audited Amount</th>
                    <th class="px-6 py-3 text-right">Balance</th>
                    <th class="px-6 py-3 text-left">Pre-auditor</th>
                    <th class="px-6 py-3 text-left">Supporting File</th>
                    <th class="px-6 py-3 text-center">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">

                <!-- Opening Balance -->
                <tr class="bg-blue-50 dark:bg-blue-900/30">
                    <td class="px-6 py-4 text-gray-500 text-xs">—</td>
                    <td class="px-6 py-4 font-semibold text-blue-700 dark:text-blue-300">
                        Starting Balance
                    </td>
                    <td class="px-6 py-4 text-right">—</td>
                    <td class="px-6 py-4 text-right font-bold text-blue-600 dark:text-blue-400">
                        ₱{{ number_format($runningBalance,2) }}
                    </td>
                    <td colspan="3"></td>
                </tr>

                @foreach($liquidation->preAuditEntries->sortBy('created_at') as $entry)

                    @php
                        $amount = $entry->for_compliance > 0
                                    ? $entry->for_compliance
                                    : $entry->amount;

                        $runningBalance -= $amount;
                    @endphp

                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">

                        <!-- Date -->
                        <td class="px-6 py-4 text-xs text-gray-500 dark:text-gray-400">
                            {{ $entry->created_at->format('M d, Y h:i A') }}
                        </td>

                        <!-- Description -->
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full
                                    {{ $entry->for_compliance > 0 
                                        ? 'bg-yellow-500' 
                                        : 'bg-green-500' }}">
                                </span>
                                <span class="font-medium">
                                    {{ $entry->for_compliance > 0 ? 'For Compliance' : 'Complied' }}
                                </span>
                            </div>
                        </td>

                        <!-- Amount -->
                        <td class="px-6 py-4 text-right font-semibold
                            {{ $entry->for_compliance > 0 
                                ? 'text-yellow-600 dark:text-yellow-400'
                                : 'text-green-600 dark:text-green-400' }}">
                            ₱{{ number_format($amount,2) }}
                        </td>

                        <!-- Running Balance -->
                        <td class="px-6 py-4 text-right font-bold
                            {{ $runningBalance == 0
                                ? 'text-blue-600 dark:text-blue-400'
                                : ($runningBalance < 0 ? 'text-red-600' : '') }}">
                            ₱{{ number_format($runningBalance,2) }}
                        </td>

                        <!-- Auditor -->
                        <td class="px-6 py-4">
                            {{ $entry->preAuditor?->name ?? 'N/A' }}
                        </td>

                        <!-- File -->
                        <td class="px-6 py-4">
                            @if($entry->compliance_file)
                                <a href="{{ asset('storage/'.$entry->compliance_file) }}"
                                target="_blank"
                                class="text-blue-600 dark:text-blue-400 hover:underline text-xs">
                                    View
                                </a>
                            @else
                                <span class="text-gray-400 text-xs">—</span>
                            @endif
                        </td>

                        <!-- Action -->
                        <td class="px-6 py-4 text-center">
                            @if($liquidation->status === 'Draft')
                                <div class="flex justify-center gap-2">

                                    <!-- Edit Button -->
                                    <button 
                                        @click="$dispatch('open-edit-preaudit', {
                                            id: '{{ $entry->id }}',
                                            amount: '{{ $entry->amount }}',
                                            compliance: '{{ $entry->for_compliance }}',
                                            auditorName: '{{ $entry->preAuditor?->name }}',
                                            fileExists: {{ $entry->compliance_file ? 'true' : 'false' }}
                                        })"
                                        class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs px-3 py-1 rounded shadow-sm transition">
                                        Edit
                                    </button>

                                    <!-- Delete Button -->
                                    <button
                                        @click="$dispatch('open-delete-preaudit', {
                                            id: '{{ $entry->id }}'
                                        })"
                                        class="bg-red-600 hover:bg-red-700 text-white text-xs px-3 py-1 rounded shadow-sm transition">
                                        Delete
                                    </button>

                                </div>
                            @endif
                        </td>
                    </tr>

                @endforeach

                <!-- Closing Balance -->
                <tr class="bg-gray-100 dark:bg-gray-800 font-semibold">
                    <td colspan="3" class="px-6 py-4 text-right">
                        Remaining Balance
                    </td>
                    <td class="px-6 py-4 text-right
                        {{ $runningBalance == 0 
                            ? 'text-blue-600 dark:text-blue-400' 
                            : 'text-red-600' }}">
                        ₱{{ number_format($runningBalance,2) }}
                    </td>
                    <td colspan="3"></td>
                </tr>

            </tbody>
        </table>
    </div>
</div>


        <!-- History Panel -->
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4">
            <h3 class="text-sm font-semibold mb-3 text-gray-800 dark:text-gray-100">
                Activity History
            </h3>

            <div class="space-y-3 max-h-[420px] overflow-y-auto">
                @foreach($liquidation->activities->sortByDesc('created_at') as $activity)
                    <div class="border-b border-gray-200 dark:border-gray-700 pb-2">
                        <div class="flex justify-between text-sm">
                            <span class="font-medium text-gray-800 dark:text-gray-100">
                                {{ optional($activity->user)->name ?? 'System' }}
                            </span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $activity->created_at->format('M d, Y h:i A') }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-700 dark:text-gray-300">
                            {{ $activity->action }}
                        </p>
                        @if($activity->details)
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $activity->details }}
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

    </div>
<!-- Add Pre-Audit Modal -->
<div 
    x-data="{ 
        open: {{ ($errors->has('amount') || $errors->has('amounts')) ? 'true' : 'false' }},
        liquidationId: {{ old('liquidation_id') ?? 'null' }},
        forCompliance: '{{ old('for_compliance', '0') }}',
        rows: [{ auditor:'', amount:'' }],

        handleSubmit($event){
            const form = $event.target;

            form.querySelectorAll('.dynamic-hidden').forEach(el => el.remove());

            if(this.forCompliance === '1'){
                this.rows.forEach((row,i)=>{
                    let auditor = document.createElement('input');
                    auditor.type='hidden';
                    auditor.name=`pre_auditors[${i}]`;
                    auditor.value=row.auditor;
                    auditor.classList.add('dynamic-hidden');
                    form.appendChild(auditor);

                    let amount = document.createElement('input');
                    amount.type='hidden';
                    amount.name=`amounts[${i}]`;
                    amount.value=row.amount;
                    amount.classList.add('dynamic-hidden');
                    form.appendChild(amount);
                });
            }
        }
    }"

    x-on:open-preaudit-modal.window="
        open=true;
        liquidationId=$event.detail.id;
    "
>

    <div x-show="open"
         x-cloak
         class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">

        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-lg w-full max-w-lg p-6">

            <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100">
                Add Pre-Audit Entry
            </h2>

            <!-- 🔴 Error Message -->
            @if ($errors->has('amount') || $errors->has('amounts'))
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded text-sm">
                    {{ $errors->first('amount') ?? $errors->first('amounts') }}
                </div>
            @endif

<form method="POST"
      action="{{ route('pre-auditor.liquidations.add-entry') }}"
      enctype="multipart/form-data"
      @submit.prevent="handleSubmit($event); $event.target.submit();">

@csrf
<input type="hidden" name="liquidation_id" :value="liquidationId">

<!-- Entry Type -->
<div class="mb-4">
<label class="block text-sm mb-1">Entry Type</label>
<select name="for_compliance"
        x-model="forCompliance"
        class="w-full border rounded px-3 py-2 bg-white dark:bg-gray-800 dark:border-gray-700">
<option value="0">Complied</option>
<option value="1">For Compliance</option>
</select>
</div>

<!-- Complied -->
<div class="mb-4" x-show="forCompliance==='0'">
<label class="block text-sm mb-1">Amount</label>
<input type="number" step="0.01" name="amount"
class="w-full border rounded px-3 py-2 bg-white dark:bg-gray-800 dark:border-gray-700">
</div>

<!-- For Compliance -->
<div x-show="forCompliance==='1'" class="mb-4">

<template x-for="(row,index) in rows" :key="index">
<div class="flex gap-2 mb-2">

<select x-model="row.auditor"
class="w-1/2 border rounded px-2 py-2 bg-white dark:bg-gray-800 dark:border-gray-700">
<option value="">Auditor</option>
@foreach($pre_auditors as $pre)
<option value="{{ $pre->user_id }}">{{ $pre->user->name }}</option>
@endforeach
</select>

<input type="number"
       step="0.01"
       placeholder="Amount"
       x-model="row.amount"
       class="w-1/2 border rounded px-2 py-2 bg-white dark:bg-gray-800 dark:border-gray-700">

<button type="button"
        x-show="rows.length>1"
        @click="rows.splice(index,1)"
        class="text-red-600 text-xs">✕</button>

</div>
</template>

<button type="button"
        @click="rows.push({auditor:'',amount:''})"
        class="text-sm text-blue-600">
+ Add row
</button>

<!-- File -->
<div class="mt-4">
<label class="block text-sm mb-1">Supporting File</label>
<input type="file" name="supporting_file" class="w-full text-sm">
</div>

</div>

<div class="flex justify-end gap-2 mt-4">
<button type="button"
        @click="open=false"
        class="px-4 py-2 bg-gray-300 dark:bg-gray-700 rounded">
Cancel
</button>

<button type="submit"
        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
Save
</button>
</div>

</form>
</div>
</div>
</div>


    <!-- Edit Modal -->
    <div 
        x-data="{ 
            open: {{ $errors->has('edit_error') ? 'true' : 'false' }},
            entryId:null, 
            amount:null, 
            compliance:null,
            auditorName:null,
            fileExists:false
        }"

        x-on:open-edit-preaudit.window="
            open=true;
            entryId=$event.detail.id;
            amount=$event.detail.amount;
            compliance=$event.detail.compliance;
            auditorName=$event.detail.auditorName;
            fileExists=$event.detail.fileExists;
        "
    >

        <div x-show="open"
            x-cloak
            class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">

            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-lg w-full max-w-lg p-6">

                <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100">
                    Edit Pre-Audit Entry
                </h2>
                @if ($errors->has('edit_error'))
                    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded text-sm">
                        {{ $errors->first('edit_error') }}
                    </div>
                @endif

                <form method="POST" 
                    :action="`/pre-auditor-entry/${entryId}`"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PATCH')

                    <!-- ========================= -->
                    <!-- CASE 1: COMPLIED ENTRY -->
                    <!-- ========================= -->
                    <div x-show="compliance == 0">

                        <label class="block text-sm mb-1">Complied Amount</label>
                        <input type="number"
                            step="0.01"
                            name="amount"
                            x-model="amount"
                            class="w-full border rounded px-3 py-2 bg-white dark:bg-gray-800 dark:border-gray-700">

                    </div>

                    <!-- ========================= -->
                    <!-- CASE 2: FOR COMPLIANCE -->
                    <!-- ========================= -->
                    <div x-show="compliance > 0">

                        <!-- Auditor -->
                        <div class="mb-3">
                            <label class="block text-sm mb-1">Pre-Auditor</label>
                            <select name="pre_auditor_id"
                                    class="w-full border rounded px-3 py-2 bg-white dark:bg-gray-800 dark:border-gray-700">

                                @foreach($pre_auditors as $pre)
                                    <option value="{{ $pre->user_id }}"
                                        {{ old('pre_auditor_id', '') == $pre->user_id ? 'selected' : '' }}>
                                        {{ $pre->user->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <!-- Amount -->
                        <div class="mb-3">
                            <label class="block text-sm mb-1">For Compliance Amount</label>
                            <input type="number"
                                step="0.01"
                                name="for_compliance"
                                x-model="compliance"
                                class="w-full border rounded px-3 py-2 bg-white dark:bg-gray-800 dark:border-gray-700">
                        </div>

                        <!-- File -->
                        <div class="mb-3">
                            <label class="block text-sm mb-1">Replace Supporting File</label>
                            <input type="file"
                                name="supporting_file"
                                class="w-full text-sm">
                        </div>

                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end gap-2 mt-4">

                        <button type="button"
                                @click="open=false"
                                class="px-4 py-2 bg-gray-300 dark:bg-gray-700 rounded">
                            Cancel
                        </button>

                        <button type="submit"
                                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            Update
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div 
        x-data="{ open:false, entryId:null }"
        x-on:open-delete-preaudit.window="
            open=true;
            entryId=$event.detail.id;
        "
    >

        <div x-show="open"
            x-cloak
            class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">

            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-lg w-full max-w-md p-6">

                <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100">
                    Confirm Deletion
                </h2>

                <p class="text-sm text-gray-600 dark:text-gray-300 mb-6">
                    Are you sure you want to delete this pre-audit entry?
                    <br><br>
                    <span class="text-red-600 font-semibold">
                        This action cannot be undone.
                    </span>
                </p>

                <div class="flex justify-end gap-3">

                    <!-- Cancel -->
                    <button type="button"
                            @click="open=false"
                            class="px-4 py-2 bg-gray-300 dark:bg-gray-700 rounded">
                        Cancel
                    </button>

                    <!-- Confirm Delete -->
                    <form method="POST"
                        :action="`/pre-auditor-entry/${entryId}`">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            Yes, Delete
                        </button>
                    </form>

                </div>

            </div>
        </div>
    </div>

</div>

@if(session('error'))
<div 
    x-data="{ open: true }"
    x-show="open"
    x-cloak
    class="fixed inset-0 flex items-center justify-center z-50"
>
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>

    <!-- Modal -->
    <div class="relative bg-white dark:bg-gray-800 
                rounded-xl shadow-2xl w-full max-w-md mx-4 p-6">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-red-600 dark:text-red-400">
                Action Not Allowed
            </h2>
            <button @click="open = false"
                    class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                ✕
            </button>
        </div>

        <div class="text-sm text-gray-700 dark:text-gray-300 mb-6">
            {{ session('error') }}
        </div>

        <div class="text-right">
            <button 
                @click="open = false"
                class="bg-red-600 hover:bg-red-700 text-white 
                       px-4 py-2 rounded-lg text-sm">
                OK
            </button>
        </div>
    </div>
</div>
@endif

<style>
    [x-cloak] { display: none !important; }
</style>

</x-app-layout>
