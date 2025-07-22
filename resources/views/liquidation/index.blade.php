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

                    <button type="button" @click="openImportModal = true"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded-md">
                        Import JEV
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
                                <th class="px-6 py-3">Amount for Compliance</th>
                                <th class="px-6 py-3">Pre-Audited Amount</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3">Type</th>
                                <th class="px-6 py-3">Received</th>
                                <th class="px-6 py-3">Reference (LR/OR)</th>
                                <th class="px-6 py-3">Reviewed Date</th>
                                <th class="px-6 py-3">Pre-Auditor</th>
                                <th class="px-6 py-3 text-center">Action</th>
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
                                <tr class="{{ $loop->odd ? 'bg-white dark:bg-gray-800' : 'bg-gray-50 dark:bg-gray-700' }} hover:bg-blue-50 dark:hover:bg-gray-600 transition" onclick="toggleEntry({{ $liq->id }})">
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
                                    <td class="px-6 py-3 text-center">
                                        @foreach ($liq->preAuditors as $auditor)
                                            <a href="{{ route('pre-auditors.liquidations', $auditor->id) }}" onclick="event.stopPropagation()"
                                                class="text-blue-600 hover:underline dark:text-blue-400 dark:hover:text-blue-300">
                                                {{ $auditor->name }}
                                            </a>
                                        @endforeach
                                    </td>

                                    {{-- Actions --}}
                                    <td class="px-4 py-2 text-center space-y-2">
                                       <div class="flex justify-center gap-2" onclick="event.stopPropagation()">

                                            @if (in_array($liq->status, ['For Checking', 'Processing']))
                                                <button 
                                                    onclick="event.stopPropagation(); document.getElementById('modal-{{ $liq->id }}').classList.remove('hidden')" 
                                                    class="bg-blue-600 hover:bg-blue-700 text-white text-xs px-3 py-1 rounded">
                                                    Add Pre-Audit
                                                </button>

                                                <form action="{{ route('liquidation.set-draft', $liq->id) }}" method="POST" onclick="event.stopPropagation()" onsubmit="event.stopPropagation()">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                            class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1 rounded text-xs">
                                                        Set as Draft
                                                    </button>
                                                </form>
                                            @endif

                                            @if (in_array($liq->status, ['For Transmittal', 'Transmitted']))
                                                <a href="{{ route('liquidation.edit', $liq->id) }}"
                                                    onclick="event.stopPropagation()"
                                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs">
                                                    Edit
                                                </a>

                                                <form action="{{ route('liquidation.set-draft', $liq->id) }}" method="POST" onclick="event.stopPropagation()" onsubmit="event.stopPropagation()">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                            class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1 rounded text-xs">
                                                        Set as Draft
                                                    </button>
                                                </form>
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

                                            @if ($liq->status === 'For Approval')    
                                                <form action="{{ route('liquidation.approve', $liq->id) }}" method="POST" onclick="event.stopPropagation()" onsubmit="event.stopPropagation()">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                            class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs">
                                                        Approve
                                                    </button>
                                                </form>

                                                <form action="{{ route('liquidation.set-draft', $liq->id) }}" method="POST" onclick="event.stopPropagation()" onsubmit="event.stopPropagation()">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                            class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1 rounded text-xs">
                                                        Set as Draft
                                                    </button>
                                                </form>
                                            @endif

                                            @if ($liq->status === 'Approved')
                                                <form action="{{ route('liquidation.set-draft', $liq->id) }}" method="POST" onclick="event.stopPropagation()" onsubmit="event.stopPropagation()">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                            class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1 rounded text-xs">
                                                        Set as Draft
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <!-- Add Pre-Audited Modal -->
                                <div id="modal-{{ $liq->id }}" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center hidden">
                                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg w-full max-w-md">
                                        <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">
                                            Add Pre-Audited Entry — {{ $liq->liq_number ?? $liq->check_number }}
                                        </h2>

                                        {{-- Show form errors --}}
                                        @if ($errors->any())
                                            <div class="mb-4 bg-red-100 text-red-700 px-4 py-2 rounded">
                                                <ul class="text-sm list-disc pl-5">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <form method="POST" action="{{ route('pre-auditor.liquidations.add-entry') }}"
                                            enctype="multipart/form-data" id="entry-form-{{ $liq->id }}">
                                            @csrf

                                            <input type="hidden" name="liquidation_id" value="{{ $liq->id }}">

                                            {{-- Amount --}}
                                            <div class="mb-4">
                                                <label class="block text-gray-700 dark:text-gray-300 mb-1">Amount</label>
                                                <input type="number" name="amount" step="0.01" placeholder="₱0.00" required
                                                    class="w-full px-3 py-2 border rounded dark:bg-gray-900 dark:border-gray-600 dark:text-white">
                                            </div>

                                            {{-- Entry Type --}}
                                            <div class="mb-4">
                                                <label class="block text-gray-700 dark:text-gray-300 mb-1">Entry Type</label>
                                                <select name="for_compliance" required
                                                        class="w-full px-3 py-2 border rounded dark:bg-gray-900 dark:border-gray-600 dark:text-white"
                                                        onchange="toggleFileInput(this, '{{ $liq->id }}')">
                                                    <option value="0">Complied</option>
                                                    <option value="1">For Compliance</option>
                                                </select>
                                            </div>

                                            {{-- Supporting File --}}
                                            <div class="mb-4 hidden" id="file-input-container-{{ $liq->id }}">
                                                <label class="block text-gray-700 dark:text-gray-300 mb-1">Supporting File (PDF, JPG, PNG)</label>
                                                <input type="file" name="supporting_file" accept=".pdf,.jpg,.jpeg,.png"
                                                    class="w-full px-3 py-2 border rounded dark:bg-gray-900 dark:border-gray-600 dark:text-white"
                                                    id="supporting-file-{{ $liq->id }}">
                                            </div>

                                            {{-- Actions --}}
                                            <div class="flex justify-end space-x-2">
                                                <button type="button"
                                                    onclick="document.getElementById('modal-{{ $liq->id }}').classList.add('hidden')"
                                                    class="px-4 py-2 bg-gray-400 hover:bg-gray-500 text-white rounded">
                                                    Cancel
                                                </button>
                                                <button type="submit"
                                                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded"
                                                    onclick="return validateFileInput('{{ $liq->id }}')">
                                                    Save
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Collapsible Entry Table -->
                                @if($entries->count())
                                    <tr id="entries-{{ $liq->id }}" class="hidden bg-gray-50 dark:bg-gray-700">
                                        <td colspan="9" class="px-4 py-2">
                                            <table class="w-full text-xs text-left">
                                                <thead>
                                                    <tr class="text-gray-600 dark:text-gray-300">
                                                        <th class="py-1 px-2">Amount</th>
                                                        <th class="py-1 px-2">Type</th>
                                                        <th class="py-1 px-2">Date Submitted</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($entries as $entry)
                                                        @php
                                                            $isCompliance = $entry->for_compliance > 0;
                                                            $displayAmount = $isCompliance ? $entry->for_compliance : $entry->amount;
                                                            $typeLabel = $isCompliance ? 'For Compliance' : 'Complied';
                                                            $textColor = $isCompliance ? 'text-yellow-600' : 'text-green-600';
                                                        @endphp

                                                        @if($displayAmount > 0)
                                                            <tr class="border-t border-gray-300 dark:border-gray-600">
                                                                <td class="py-1 px-2">₱{{ number_format($displayAmount, 2) }}</td>
                                                                <td class="py-1 px-2">
                                                                    <span class="text-xs font-semibold {{ $textColor }}">
                                                                        {{ $typeLabel }}
                                                                    </span>
                                                                </td>
                                                                <td class="py-1 px-2">{{ $entry->created_at->format('M d, Y h:i A') }}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
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

<script>
    function toggleEntry(id) {
        const target = document.getElementById(`entries-${id}`);
        const isHidden = target.classList.contains('hidden');

        // Close all
        document.querySelectorAll('[id^="entries-"]').forEach(el => el.classList.add('hidden'));

        // Only open if it was previously hidden
        if (isHidden) {
            target.classList.remove('hidden');
        }
    }
</script>
<script>
    function toggleFileInput(select, id) {
        const container = document.getElementById('file-input-container-' + id);
        const input = document.getElementById('supporting-file-' + id);
        if (select.value === '1') {
            container.classList.remove('hidden');
            input.required = true;
        } else {
            container.classList.add('hidden');
            input.required = false;
        }
    }

    function validateFileInput(id) {
        const select = document.querySelector(`#entry-form-${id} select[name="for_compliance"]`);
        const fileInput = document.getElementById('supporting-file-' + id);

        if (select.value === '1' && !fileInput.value) {
            alert('Please attach a supporting file for compliance.');
            return false;
        }
        return true;
    }
</script>

</x-app-layout>
