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

        <div class="py-6" x-data="{ openExportModal: false, openImportModal: false }">
        <div class="mx-8">
            <div class="w-full px-4 mx-auto">
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-md overflow-hidden">
            
                    <div class="px-6 pt-6 flex justify-end gap-2">
                        <button type="button" @click="openExportModal = true"
                            class="bg-green-600 hover:bg-green-700 text-white text-sm px-4 py-2 rounded-md">
                            Export
                        </button>
                        @hasanyrole('admin|reporting')
                        <button type="button" @click="openImportModal = true"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded-md">
                            Import JEV
                        </button>
                        @endhasanyrole
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

                                {{-- Status Filter --}}
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                    <select name="status" id="status"
                                            class="mt-1 block w-44 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm">
                                        <option value="">All</option>
                                        <option value="For Checking" {{ request('status') == 'For Checking' ? 'selected' : '' }}>For Checking</option>
                                        <option value="Processing" {{ request('status') == 'Processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="Approved" {{ request('status') == 'Approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="For Approval" {{ request('status') == 'For Approval' ? 'selected' : '' }}>For Approval</option>
                                        <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="Draft" {{ request('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
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
                                        Apply Filter
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
                                    <th class="px-6 py-3">Liq Amount Received</th>
                                    <th class="px-6 py-3">For Compliance</th>
                                    <th class="px-6 py-3">Pre-Audited Amount</th>
                                    <th class="px-6 py-3">Status</th>
                                    <th class="px-6 py-3">Type</th>
                                    <th class="px-6 py-3">Received</th>
                                    <th class="px-6 py-3">Reference (LR/OR)</th>
                                    <th class="px-6 py-3">OR Date/Reviewed Date</th>
                                    <th class="px-6 py-3 text-center">Action</th>
                                    <th class="px-6 py-3">History</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($liquidations as $liq)
                                @php
                                        $entries = $liq->preAuditEntries
                                            ->where('pre_auditor_id', optional($liq->preAuditors->first())->id)
                                            ->sortByDesc('created_at');

                                        $totalPreAudited = $entries->sum(function ($entry) {
                                            return ($entry->amount ?? 0) + ($entry->for_compliance ?? 0);
                                        });

                                        $hasComplianceEntry = $entries->where('for_compliance', '>', 0)->count() > 0;

                                        $isComplete = ($liq->for_liquidation_amount - $totalPreAudited) == 0 && $hasComplianceEntry;
                                    @endphp
                                    <tr class="{{ $loop->odd ? 'bg-white dark:bg-gray-800' : 'bg-gray-50 dark:bg-gray-700' }} hover:bg-blue-50 dark:hover:bg-gray-600 transition cursor-pointer"
    onclick="toggleEntry({{ $liq->id }})">
                                        <td class="px-6 py-3">{{ $liq->sdo_name }}</td>
                                        <td class="px-6 py-3">
                                            <a href="{{ route('liquidation.show', $liq->cash_advance_id) }}" onclick="event.stopPropagation()" class="text-blue-600 hover:underline">
                                                {{ $liq->check_number }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-3">₱{{ number_format(abs($liq->for_liquidation_amount), 2) }}</td>
                                        <td class="px-6 py-3">₱{{ number_format($liq->for_compliance_amount ?? 0, 2) }}</td>
                                        <td class="px-6 py-3">₱{{ number_format($liq->pre_audited_amount ?? 0, 2) }}</td>
                                        <td class="px-6 py-3">
                                                @php
                                                    $status = $liq->status;
                                                    $statusStyles = [
                                                        'For Checking' => 'bg-yellow-200 text-yellow-800',
                                                        'Processing'   => 'bg-orange-200 text-orange-800',
                                                        'Approved'     => 'bg-green-100 text-green-800',
                                                        'For Approval' => 'bg-blue-200 text-blue-800',
                                                        'Completed'    => 'bg-gray-300 text-gray-900',
                                                    ];
                                                @endphp

                                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full {{ $statusStyles[$status] ?? 'bg-gray-100 text-gray-800' }}">
                                                    {{ $status ?? '—' }}
                                                </span>
                                            </td>
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
                                        <td class="px-4 py-2 text-center space-y-2">
                                        <div class="flex justify-center gap-2" onclick="event.stopPropagation()">

                                                @if (in_array($liq->status, ['For Checking', 'Processing']))
                                                    <!-- <button 
                                                        @click="$dispatch('open-modal', '{{ $liq->id }}')"
                                                        class="bg-blue-600 hover:bg-blue-700 text-white text-xs px-3 py-1 rounded">
                                                        Add Pre-Audit
                                                    </button> -->
                                                    <button 
                                                        @click="$dispatch('open-preaudit-modal', { id: '{{ $liq->id }}' })"
                                                        class="bg-blue-600 hover:bg-blue-700 text-white text-xs px-3 py-1 rounded">
                                                        Add Pre-Audit
                                                    </button>
                                                    @role('admin')
                                                    <form action="{{ route('liquidation.set-draft', $liq->id) }}" method="POST" onclick="event.stopPropagation()" onsubmit="event.stopPropagation()">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                                class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1 rounded text-xs">
                                                            Set as Draft
                                                        </button>
                                                    </form>
                                                    @endrole
                                                @endif

                                                @if (in_array($liq->status, ['For Transmittal', 'Transmitted']))
                                                    <!-- <a href="{{ route('liquidation.edit', $liq->id) }}"
                                                        onclick="event.stopPropagation()"
                                                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs">
                                                        Edit
                                                    </a> -->
                                                    @role('admin')
                                                    <form action="{{ route('liquidation.set-draft', $liq->id) }}" method="POST" onclick="event.stopPropagation()" onsubmit="event.stopPropagation()">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                                class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1 rounded text-xs">
                                                            Set as Draft
                                                        </button>
                                                    </form>
                                                    @endrole
                                                @endif

                                                @if ($liq->status === 'Draft' && $liq->liquidation_type === 'Refund')
                                                    <a href="{{ route('liquidation.edit', $liq->id) }}"
                                                        onclick="event.stopPropagation()"
                                                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs">
                                                        Edit
                                                    </a>

                                                    <form action="{{ route('liquidation.markForApproval', $liq->id) }}" method="POST" onclick="event.stopPropagation()" onsubmit="event.stopPropagation()">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                                class="bg-purple-600 hover:bg-purple-700 text-white px-3 py-1 rounded text-xs">
                                                            Done
                                                        </button>
                                                    </form>
                                                @endif

                                                @if ($liq->status === 'Draft' && $liq->liquidation_type === 'Liquidation')
                                                    <a href="{{ route('liquidation.edit', $liq->id) }}"
                                                        onclick="event.stopPropagation()"
                                                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs">
                                                        Edit
                                                    </a>

                                                    <form action="{{ route('liquidation.markForApproval', $liq->id) }}" method="POST" onclick="event.stopPropagation()" onsubmit="event.stopPropagation()">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                                class="bg-purple-600 hover:bg-purple-700 text-white px-3 py-1 rounded text-xs">
                                                            Done
                                                        </button>
                                                    </form>
                                                @endif

                                                @if ($liq->status === 'For Approval')    
                                                    <form action="{{ route('liquidation.approve', $liq->id) }}" method="POST" onclick="event.stopPropagation()" onsubmit="event.stopPropagation()">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                                class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs">
                                                            Approve
                                                        </button>
                                                    </form>
                                                    @role('admin')
                                                    <form action="{{ route('liquidation.set-draft', $liq->id) }}" method="POST" onclick="event.stopPropagation()" onsubmit="event.stopPropagation()">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                                class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1 rounded text-xs">
                                                            Set as Draft
                                                        </button>
                                                    </form>
                                                    @endrole
                                                @endif

                                                @if ($liq->status === 'Approved')
                                                @role('admin')
                                                    <form action="{{ route('liquidation.set-draft', $liq->id) }}" method="POST" onclick="event.stopPropagation()" onsubmit="event.stopPropagation()">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                                class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1 rounded text-xs">
                                                            Set as Draft
                                                        </button>
                                                    </form>
                                                    @endrole
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-3">
                                            <button 
                                                onclick="document.getElementById('history-modal-{{ $liq->id }}').classList.remove('hidden')" 
                                                class="text-blue-600 hover:underline">
                                                View
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Activity History Modal -->
                                    <div id="history-modal-{{ $liq->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                                        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-xl w-full max-w-xl p-6">
                                            <!-- Modal Header -->
                                            <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-700 pb-3 mb-4">
                                                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
                                                    Activity History — {{ $liq->liq_number ?? $liq->check_number }}
                                                </h2>
                                                <button onclick="document.getElementById('history-modal-{{ $liq->id }}').classList.add('hidden')" 
                                                        class="text-gray-400 hover:text-red-500 text-2xl leading-none font-bold">
                                                    &times;
                                                </button>
                                            </div>

                                            <!-- Modal Content -->
                                            @if ($liq->activities->count())
                                                <ul class="divide-y divide-gray-200 dark:divide-gray-700 max-h-80 overflow-y-auto">
                                                    @foreach ($liq->activities as $activity)
                                                        <li class="py-3">
                                                            <div class="flex items-center justify-between">
                                                                <div>
                                                                    <p class="text-sm font-medium text-gray-800 dark:text-white">
                                                                        {{ optional($activity->user)->name ?? 'System' }}
                                                                        <span class="text-gray-500 dark:text-gray-400 font-normal">
                                                                            — {{ $activity->action }}
                                                                        </span>
                                                                    </p>
                                                                    @if ($activity->details)
                                                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                                            {{ $activity->details }}
                                                                        </p>
                                                                    @endif
                                                                </div>
                                                                <span class="text-xs text-gray-400 dark:text-gray-500 whitespace-nowrap">
                                                                    {{ $activity->created_at->format('M d, Y h:i A') }}
                                                                </span>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <p class="text-sm text-gray-600 dark:text-gray-300 text-center">No activity recorded.</p>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Add Pre-Audited Modal -->
                                    <div 
                                        x-data="{ 
                                            show: false, 
                                            forCompliance: '0', 
                                            rows: [{ auditor: '', amount: '' }],
                                            handleSubmit($event) {
                                                // Before submitting, remove any old hidden inputs
                                                const form = $event.target.closest('form');
                                                form.querySelectorAll('.dynamic-hidden').forEach(el => el.remove());

                                                // If For Compliance mode, inject dynamic inputs
                                                if (this.forCompliance === '1') {
                                                    this.rows.forEach((row, i) => {
                                                        const auditorInput = document.createElement('input');
                                                        auditorInput.type = 'hidden';
                                                        auditorInput.name = `pre_auditors[${i}]`;
                                                        auditorInput.value = row.auditor;
                                                        auditorInput.classList.add('dynamic-hidden');
                                                        form.appendChild(auditorInput);

                                                        const amountInput = document.createElement('input');
                                                        amountInput.type = 'hidden';
                                                        amountInput.name = `amounts[${i}]`;
                                                        amountInput.value = row.amount;
                                                        amountInput.classList.add('dynamic-hidden');
                                                        form.appendChild(amountInput);
                                                    });
                                                }
                                            }
                                        }"
                                        x-show="show"
                                        x-cloak
                                        @open-preaudit-modal.window="if ($event.detail.id == '{{ $liq->id }}') show = true"
                                        class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center"
                                    >
                                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg w-full max-w-lg" @click.outside="show = false">
                                            <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">
                                                Add Pre-Audited Entry — {{ $liq->liq_number ?? $liq->check_number }}
                                            </h2>

                                            {{-- Validation Errors --}}
                                            @if ($errors->any())
                                                <div class="mb-4 bg-red-100 text-red-700 px-4 py-2 rounded">
                                                    <ul class="text-sm list-disc pl-5">
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                            {{-- FORM --}}
                                            <form 
                                                id="entry-form-{{ $liq->id }}"
                                                method="POST"
                                                action="{{ route('pre-auditor.liquidations.add-entry') }}"
                                                enctype="multipart/form-data"
                                                @submit.prevent="handleSubmit($event); $event.target.submit();"
                                            >
                                                @csrf
                                                <input type="hidden" name="liquidation_id" value="{{ $liq->id }}">

                                                {{-- Entry Type --}}
                                                <div class="mb-4">
                                                    <label class="block text-gray-700 dark:text-gray-300 mb-1">Entry Type</label>
                                                    <select 
                                                        name="for_compliance" 
                                                        x-model="forCompliance" 
                                                        required
                                                        class="w-full px-3 py-2 border rounded dark:bg-gray-900 dark:border-gray-600 dark:text-white"
                                                    >
                                                        <option value="0">Complied</option>
                                                        <option value="1">For Compliance</option>
                                                    </select>
                                                </div>

                                                {{-- Complied Amount --}}
                                                <div class="mb-4" x-show="forCompliance === '0'" x-cloak>
                                                    <label class="block text-gray-700 dark:text-gray-300 mb-1">Amount</label>
                                                    <input 
                                                        type="number" 
                                                        name="amount" 
                                                        step="0.01" 
                                                        placeholder="₱0.00" 
                                                        x-bind:required="forCompliance === '0'"
                                                        class="w-full px-3 py-2 border rounded dark:bg-gray-900 dark:border-gray-600 dark:text-white"
                                                    >
                                                </div>

                                                {{-- For Compliance Section --}}
                                                <div class="mb-4" x-show="forCompliance === '1'" x-cloak>
                                                    <template x-for="(row, index) in rows" :key="index">
                                                        <div class="flex space-x-2 mb-2 items-center">
                                                            <!-- Pre-Auditor -->
                                                            <select 
                                                                x-model="row.auditor"
                                                                class="w-1/2 px-3 py-2 border rounded dark:bg-gray-900 dark:border-gray-600 dark:text-white"
                                                            >
                                                                <option value="">Select Pre-Auditor</option>
                                                                @foreach ($pre_auditors as $pre)
                                                                    <option value="{{ $pre->user_id }}">{{ $pre->user->name }}</option>
                                                                @endforeach
                                                            </select>

                                                            <!-- Amount -->
                                                            <input 
                                                                type="number"
                                                                step="0.01" 
                                                                placeholder="₱0.00"
                                                                x-model="row.amount"
                                                                class="w-1/2 px-3 py-2 border rounded dark:bg-gray-900 dark:border-gray-600 dark:text-white"
                                                            >

                                                            <!-- Remove Button -->
                                                            <button 
                                                                type="button"
                                                                class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-xs"
                                                                x-show="rows.length > 1"
                                                                @click="rows.splice(index, 1)"
                                                            >
                                                                ✕
                                                            </button>
                                                        </div>
                                                    </template>

                                                    <!-- Add Row Button -->
                                                    <button 
                                                        type="button"
                                                        class="mt-2 px-3 py-1 bg-green-600 text-white rounded text-sm"
                                                        @click="rows.push({ auditor: '', amount: '' })"
                                                    >
                                                        + Add Another
                                                    </button>

                                                    <!-- Supporting File -->
                                                    <div class="mt-4">
                                                        <label class="block text-gray-700 dark:text-gray-300 mb-1">
                                                            Supporting File (PDF, JPG, PNG)
                                                        </label>
                                                        <input 
                                                            type="file" 
                                                            name="supporting_file" 
                                                            accept=".pdf,.jpg,.jpeg,.png"
                                                            x-bind:required="forCompliance === '1'"
                                                            class="w-full px-3 py-2 border rounded dark:bg-gray-900 dark:border-gray-600 dark:text-white"
                                                        >
                                                    </div>
                                                </div>

                                                {{-- Actions --}}
                                                <div class="flex justify-end space-x-2 mt-6">
                                                    <button 
                                                        type="button"
                                                        @click="show = false"
                                                        class="px-4 py-2 bg-gray-400 hover:bg-gray-500 text-white rounded"
                                                    >
                                                        Cancel
                                                    </button>
                                                    <button 
                                                        type="submit" 
                                                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded"
                                                    >
                                                        Save
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Collapsible Entry Table -->
                                    @if($liq->preAuditEntries->count())
                                    <tr id="entries-{{ $liq->id }}" class="hidden bg-gray-50 dark:bg-gray-800">
                                        <td colspan="10" class="px-6 py-4">
                                            <div x-data="{ openDeleteModal: false, entryId: null }">

                                                @php
                                                    // Ensure starting balance is always positive
                                                    $startingBalance = abs($liq->for_liquidation_amount ?? 0);

                                                    // Compute totals before table render
                                                    $totalComplied = 0;
                                                    $totalForCompliance = 0;

                                                    foreach ($liq->preAuditEntries as $entry) {
                                                        $displayAmount = $entry->for_compliance > 0 ? $entry->for_compliance : $entry->amount;
                                                        if ($entry->for_compliance > 0) {
                                                            $totalForCompliance += $displayAmount;
                                                        } else {
                                                            $totalComplied += $displayAmount;
                                                        }
                                                    }

                                                    $grandTotal = $totalComplied + $totalForCompliance;
                                                    $variance = $startingBalance - $grandTotal;
                                                @endphp

                                                <div class="rounded-lg shadow-sm border border-gray-300 dark:border-gray-700 overflow-hidden">
                                                    <div class="bg-white dark:bg-gray-900 px-4 py-3 flex items-center justify-between border-b border-gray-200 dark:border-gray-700">
                                                        <div class="flex items-center gap-6">
                                                            <div>
                                                                <span class="text-sm text-gray-600 dark:text-gray-300">Starting Balance:</span>
                                                                <span class="text-base font-semibold text-green-700 dark:text-green-500">
                                                                    ₱{{ number_format($startingBalance, 2) }}
                                                                </span>
                                                            </div>
                                                            <div>
                                                                <span class="text-sm text-gray-600 dark:text-gray-300">Remaining Balance:</span>
                                                                <span class="text-base font-semibold {{ $variance >= 0 ? 'text-blue-700 dark:text-blue-400' : 'text-red-600 dark:text-red-400' }}">
                                                                    ₱{{ number_format($variance, 2) }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <table class="w-full text-sm text-left">
                                                        <thead class="bg-gray-100 dark:bg-gray-800 border-b border-gray-300 dark:border-gray-700">
                                                            <tr class="text-gray-700 dark:text-gray-300">
                                                                <th class="py-2 px-3 font-semibold">Type</th>
                                                                <th class="py-2 px-3 font-semibold">Amount</th>
                                                                <th class="py-2 px-3 font-semibold">Running Balance</th>
                                                                <th class="py-2 px-3 font-semibold">Supporting Document</th>
                                                                <th class="py-2 px-3 font-semibold">Pre-Auditor</th>
                                                                <th class="py-2 px-3 font-semibold">Date Submitted</th>
                                                                <th class="py-2 px-3 font-semibold text-center">Action</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                                            @php
                                                                $runningBalance = $startingBalance;
                                                                $totalComplied = 0;
                                                                $totalForCompliance = 0;
                                                            @endphp

                                                            @foreach($liq->preAuditEntries as $entry)
                                                                @php
                                                                    $isCompliance = $entry->for_compliance > 0;
                                                                    $displayAmount = $isCompliance ? $entry->for_compliance : $entry->amount;
                                                                    $typeLabel = $isCompliance ? 'For Compliance' : 'Complied';
                                                                    $textColor = $isCompliance ? 'text-yellow-600 dark:text-yellow-400' : 'text-green-600 dark:text-green-400';

                                                                    if ($isCompliance) {
                                                                        $totalForCompliance += $displayAmount;
                                                                    } else {
                                                                        $totalComplied += $displayAmount;
                                                                    }

                                                                    $runningBalance = max(0, $runningBalance - $displayAmount);
                                                                @endphp

                                                                @if($displayAmount > 0)
                                                                <tr id="entry-row-{{ $entry->id }}" class="hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                                                                    <td class="py-2 px-3">
                                                                        <span class="font-medium {{ $textColor }}">{{ $typeLabel }}</span>
                                                                    </td>
                                                                    <td class="py-2 px-3">₱{{ number_format($displayAmount, 2) }}</td>
                                                                    <td class="py-2 px-3">₱{{ number_format($runningBalance, 2) }}</td>
                                                                    <td class="py-2 px-3 text-blue-600 dark:text-blue-400">
                                                                        @if ($entry->compliance_file)
                                                                            <a href="{{ asset('storage/' . $entry->compliance_file) }}" target="_blank" class="underline hover:text-blue-800 dark:hover:text-blue-300">
                                                                                {{ $entry->compliance_file_name ?? 'View File' }}
                                                                            </a>
                                                                        @else
                                                                            <span class="text-gray-500 dark:text-gray-400">N/A</span>
                                                                        @endif
                                                                    </td>
                                                                    <td class="py-2 px-3">{{ $entry->preAuditor?->name ?? 'N/A' }}</td>
                                                                    <td class="py-2 px-3">{{ $entry->created_at->format('M d, Y h:i A') }}</td>
                                                                    <td class="py-2 px-3 text-center">
                                                                        @if($liq->status === 'Draft')
                                                                        <button @click="entryId = {{ $entry->id }}; openDeleteModal = true"
                                                                                class="text-red-600 dark:text-red-400 hover:underline font-medium">
                                                                            Delete
                                                                        </button>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>

                                                        <!-- Totals -->
                                                        <tfoot class="bg-gray-50 dark:bg-gray-800 border-t border-gray-300 dark:border-gray-700">
                                                            <tr>
                                                                <td class="py-2 px-3 text-right font-semibold text-green-700 dark:text-green-400">Total Complied:</td>
                                                                <td class="py-2 px-3 font-semibold text-green-700 dark:text-green-400">₱{{ number_format($totalComplied, 2) }}</td>
                                                                <td colspan="5"></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="py-2 px-3 text-right font-semibold text-yellow-600 dark:text-yellow-400">Total For Compliance:</td>
                                                                <td class="py-2 px-3 font-semibold text-yellow-600 dark:text-yellow-400">₱{{ number_format($totalForCompliance, 2) }}</td>
                                                                <td colspan="5"></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="py-2 px-3 text-right font-bold text-gray-800 dark:text-gray-100 border-t border-gray-300 dark:border-gray-600">Total Pre-audited:</td>
                                                                <td class="py-2 px-3 font-bold text-gray-800 dark:text-gray-100 border-t border-gray-300 dark:border-gray-600">
                                                                    ₱{{ number_format($grandTotal, 2) }}
                                                                </td>
                                                                <td colspan="5"></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>

                                                <!-- Delete Modal -->
                                                <div x-show="openDeleteModal" x-cloak
                                                    class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
                                                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-96 p-6">
                                                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Confirm Delete</h3>
                                                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                                                            Are you sure you want to delete this entry? This action cannot be undone.
                                                        </p>
                                                        <div class="mt-4 flex justify-end gap-2">
                                                            <button @click="openDeleteModal = false"
                                                                    class="px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 rounded">
                                                                Cancel
                                                            </button>
                                                            <button @click="deleteEntry(entryId); openDeleteModal = false"
                                                                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded">
                                                                Delete
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                    @endif


                                @empty
                                    <tr>
                                        <td colspan="12" class="text-center px-6 py-6 text-gray-500 dark:text-gray-400">
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

                {{-- Status --}}
                <div>
                    <label class="text-sm text-gray-700 dark:text-gray-300">Status</label>
                    <select name="status"
                            class="mt-1 block w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm">
                        <option value="">All</option>
                        <option value="For Checking">For Checking</option>
                        <option value="For Approval">For Approval</option>
                        <option value="Approved">Approved</option>
                        <option value="Draft">Draft</option>
                        <option value="Processing">Processing</option>
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
        
        {{-- Import JEV Modal --}}
        <div x-show="openImportModal" x-cloak class="fixed inset-0 flex items-center justify-center z-50">
            <div class="fixed inset-0 bg-black bg-opacity-50" @click="openImportModal = false"></div>
            <form method="POST" action="{{ route('jev.import') }}" enctype="multipart/form-data"
                class="bg-white dark:bg-gray-800 p-6 rounded-md shadow-md w-full max-w-lg z-50 space-y-4">
                @csrf

                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Import JEV File</h2>

                <div>
                    <label class="block text-sm text-gray-700 dark:text-gray-300 mb-1">Upload Excel File (.xlsx)</label>
                    <input type="file" name="jev_file" accept=".xlsx" required
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" @click="openImportModal = false"
                        class="px-4 py-2 text-sm bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-white rounded">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm bg-indigo-600 hover:bg-indigo-700 text-white rounded">
                        Import
                    </button>
                </div>
            </form>
        </div>
        <!-- Global Delete Confirmation Modal -->
        <div x-data="{ open: false, entryId: null }" x-show="open" 
            class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50"
            x-cloak>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-96 p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Confirm Delete</h3>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                    Are you sure you want to delete this entry? This action cannot be undone.
                </p>
                <div class="mt-4 flex justify-end gap-2">
                    <button @click="open = false" 
                            class="px-4 py-2 bg-gray-300 dark:bg-gray-700 rounded hover:bg-gray-400 dark:hover:bg-gray-600">
                        Cancel
                    </button>
                    <button @click="deleteEntry(entryId); open = false" 
                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        Delete
                    </button>
                </div>
            </div>
        </div>
        {{-- Import Result Modal --}}
        @if(session('success') || session('warning'))
            <div x-data="{ open: true }">
                <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 max-w-lg w-full">
                        @if(session('success'))
                            <div class="flex items-center text-green-600 mb-4">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"/>
                                </svg>
                                <h2 class="text-lg font-semibold">Success</h2>
                            </div>
                            <p class="text-gray-700 dark:text-gray-300">{{ session('success') }}</p>
                        @elseif(session('warning'))
                            <div class="flex items-center text-yellow-600 mb-4">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <h2 class="text-lg font-semibold">Warning</h2>
                            </div>
                            <p class="text-gray-700 dark:text-gray-300">{{ session('warning') }}</p>

                            {{-- Skipped entries --}}
                            @if(session('skippedLiquidations'))
                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                    {{ count(session('skippedLiquidations')) }} liquidation(s) skipped:
                                </p>
                                <ul class="mt-3 list-disc list-inside text-sm text-gray-700 dark:text-gray-300 max-h-40 overflow-y-auto">
                                    @foreach(session('skippedLiquidations') as $row)
                                        <li>
                                            <strong>SDO:</strong> {{ $row['sdo_name'] ?? 'Unknown SDO' }},
                                            <strong>Check #:</strong> {{ $row['check_number'] ?? 'N/A' }},
                                            <strong>LIQ #:</strong> {{ $row['liq_number'] ?? 'N/A' }}  
                                            <span class="text-red-500">({{ $row['reason'] }})</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        @endif

                        <div class="mt-6 text-right">
                            <button @click="open = false"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

<script>
document.addEventListener('DOMContentLoaded', () => {
    window.toggleEntry = function(id) {
        const target = document.getElementById(`entries-${id}`);
        if (!target) return;

        const isHidden = target.classList.contains('hidden');

        // Hide all collapsible rows
        document.querySelectorAll('[id^="entries-"]').forEach(el => el.classList.add('hidden'));

        // Toggle current row
        if (isHidden) {
            target.classList.remove('hidden');
        }
    };
});
</script>

<script>
function deleteEntry(entryId) {
    fetch(`/pre-auditor-entry/${entryId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
        },
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            // Reload the page after deletion
            window.location.reload();
        } else {
            alert('Failed to delete entry.');
        }
    })
    .catch(err => {
        console.error(err);
        alert('Failed to delete entry.');
    });
}
</script>
<script>
function handleEntryTypeChange(select, id) {
    const isForCompliance = select.value === '1';
    const modal = document.getElementById(`modal-${id}`);

    const complianceFields = modal.querySelector(`#for-compliance-fields-${id}`);
    const fileContainer = modal.querySelector(`#file-input-container-${id}`);
    const fileInput = modal.querySelector(`#supporting-file-${id}`);
    const compliedAmount = modal.querySelector(`#complied-amount-${id}`);
    const compliedAmountInput = compliedAmount.querySelector('input[name="amount"]');

    // Toggle visibility
    complianceFields.classList.toggle('hidden', !isForCompliance);
    fileContainer.classList.toggle('hidden', !isForCompliance);
    compliedAmount.classList.toggle('hidden', isForCompliance);

    // Toggle required attributes
    if (fileInput) fileInput.required = isForCompliance;
    if (compliedAmountInput) compliedAmountInput.required = !isForCompliance;
}

</script>
<script>
document.addEventListener('alpine:init', () => {
    Alpine.store('modal', { open: null });

    window.addEventListener('open-modal', e => {
        Alpine.store('modal').open = e.detail;
    });
});
</script>

    </x-app-layout>