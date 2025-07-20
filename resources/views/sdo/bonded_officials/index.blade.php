<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Bonded Officials') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-x-auto">
                <div class="p-8 text-gray-900 dark:text-gray-100">

                    {{-- Filter Form --}}
                    <form method="GET" class="mb-6">
                        <div class="flex flex-wrap justify-between items-center gap-4">

                            {{-- Left: Filters --}}
                            <div class="flex flex-wrap gap-3 items-center">
                                <select name="bond_status"
                                    class="appearance-none pr-8 px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-sm">
                                    <option value="">All Bond Status</option>
                                    <option value="With SO" {{ request('bond_status') === 'With SO' ? 'selected' : '' }}>With SO</option>
                                    <option value="Without SO" {{ request('bond_status') === 'Without SO' ? 'selected' : '' }}>Without SO</option>
                                </select>

                                <select name="employment_status"
                                    class="appearance-none pr-8 px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-sm">
                                    <option value="">All Employment</option>
                                    <option value="Permanent" {{ request('employment_status') === 'Permanent' ? 'selected' : '' }}>Permanent</option>
                                    <option value="Contractual" {{ request('employment_status') === 'Contractual' ? 'selected' : '' }}>Contractual</option>
                                </select>

                                <select name="expiry_filter"
                                    class="appearance-none pr-8 px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-sm">
                                    <option value="">All Expiration</option>
                                    <option value="expired" {{ request('expiry_filter') === 'expired' ? 'selected' : '' }}>Expired</option>
                                    <option value="expiring_today" {{ request('expiry_filter') === 'expiring_today' ? 'selected' : '' }}>Expiring Today</option>
                                    <option value="not_expired" {{ request('expiry_filter') === 'not_expired' ? 'selected' : '' }}>Not Yet Expired</option>
                                </select>

                                <button type="submit"
                                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 text-sm">
                                    Filter
                                </button>

                                {{-- Clear Filters --}}
                                <a href="{{ route(Route::currentRouteName()) }}"
                                    class="px-4 py-2 text-sm rounded-md border border-gray-400 dark:border-gray-600 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">
                                    Clear Filters
                                </a>
                            </div>

                            {{-- Right: Search --}}
                            <div>
                                <input type="text" id="search" name="search" value="{{ request('search') }}"
                                    placeholder="Search name"
                                    class="px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-sm w-64">
                            </div>

                        </div>
                    </form>

                    {{-- Table --}}
                    <div class="overflow-x-auto ring-1 ring-gray-200 dark:ring-gray-700">
                        <table class="min-w-[1000px] w-full text-sm text-gray-800 dark:text-gray-100 whitespace-nowrap">
                    <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-100 text-base leading-tight whitespace-normal">
                        <tr class="h-14">
                            <th class="px-4 py-4 text-center font-semibold whitespace-normal break-words max-w-[220px]">Name</th>
                            <th class="px-4 py-4 text-center font-semibold whitespace-normal break-words max-w-[200px]">Position</th>
                            <th class="px-4 py-4 text-center font-semibold whitespace-normal break-words max-w-[200px]">Official Station</th>
                            <th class="px-4 py-4 text-center font-semibold whitespace-normal break-words max-w-[200px]">Employment Status</th>
                            <th class="px-4 py-4 text-center font-semibold whitespace-nowrap max-w-none">Bond Status</th>
                            <th class="px-4 py-4 text-center font-semibold whitespace-normal break-words max-w-[220px]">Approved Amount of Bond</th>
                            <th class="px-4 py-4 text-center font-semibold whitespace-normal break-words max-w-[220px]">Max Cash Accountability</th>
                            <th class="px-4 py-4 text-center font-semibold whitespace-normal break-words max-w-[180px]">Effectivity Date</th>
                            <th class="px-4 py-4 text-center font-semibold whitespace-normal break-words max-w-[180px]">Expiration Date</th>
                            <th class="px-4 py-4 text-center font-semibold whitespace-normal break-words max-w-[200px]">Days Before Expiration</th>
                            <th class="px-4 py-4 text-center font-semibold whitespace-normal break-words max-w-[220px]">Unliquidated Amount</th>
                            <th class="px-4 py-4 text-center font-semibold whitespace-normal break-words max-w-[250px]">Email</th>
                            <th class="px-4 py-4 text-center font-semibold whitespace-normal break-words max-w-[250px]">Corporate Email</th>
                            <th class="px-4 py-4 text-center font-semibold whitespace-normal break-words max-w-[220px]">Date Received in Accounting</th>
                            <th class="px-4 py-4 text-center font-semibold whitespace-normal break-words max-w-[200px]">Date Complied</th>
                            <th class="px-4 py-4 text-center font-semibold whitespace-normal break-words max-w-[240px]">Compliance (Date Returned)</th>
                            <th class="px-4 py-4 text-center font-semibold whitespace-normal break-words max-w-[240px]">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300 dark:divide-gray-700">
                        @foreach ($officials as $bonded)
                            <form method="POST" action="{{ url('sdo/bonded-officials/' . $bonded->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $bonded->id }}">

                                <tr x-data="{ editing: false, status: '{{ $bonded->bond_status }}' }" class="hover:bg-gray-50 dark:hover:bg-gray-800 transition duration-150 ease-in-out">
                                    <td class="px-4 py-3">{{ $bonded->sdo->name }}</td>
                                    <td class="px-4 py-3">{{ $bonded->sdo->position }}</td>
                                    <td class="px-4 py-3">{{ $bonded->sdo->official_station }}</td>
                                    <td class="px-4 py-3">{{ $bonded->sdo->employment_status }}</td>

                                    {{-- Bond Status + File Input --}}
                                    <td class="px-4 py-3" x-init="$watch('status', val => {
                                        const input = $el.querySelector('input[type=file]');
                                        if (input) {
                                            input.disabled = val !== 'With SO';
                                            input.required = val === 'With SO';
                                        }
                                    })">
                                        <span x-show="!editing">{{ $bonded->bond_status }}</span>

                                        <div x-show="editing" class="space-y-2">
                                            <select x-model="status" name="bond_status" class="w-full bg-white dark:bg-gray-900 border rounded px-2 py-1 text-sm" required>
                                                <option value="" disabled>- Select -</option>
                                                <option value="With SO">With SO</option>
                                                <option value="Without SO">Without SO</option>
                                            </select>

                                            <div x-show="status === 'With SO'">
                                                <input type="file"
                                                    name="bond_file"
                                                    accept=".pdf,.doc,.docx,.jpg,.png"
                                                    class="text-sm"
                                                    :disabled="status !== 'With SO'"
                                                    :required="status === 'With SO'">

                                                @if ($bonded->bond_file_path)
                                                    <p class="text-xs text-gray-500 mt-1">
                                                        Current file:
                                                        <a href="{{ asset('storage/' . $bonded->bond_file_path) }}" target="_blank" class="text-blue-600 underline">
                                                            {{ basename($bonded->bond_file_path) }}
                                                        </a>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-4 py-3 text-right">
                                        <span x-show="!editing">{{ number_format($bonded->approved_bond_amount, 2) }}</span>
                                        <input x-show="editing" type="number" step="0.01" name="approved_bond_amount" value="{{ $bonded->approved_bond_amount }}" class="w-full bg-white dark:bg-gray-900 border rounded px-2 py-1 text-sm text-right" />
                                    </td>

                                    <td class="px-4 py-3 text-right">
                                        <span x-show="!editing">{{ number_format($bonded->max_cash, 2) }}</span>
                                        <input x-show="editing" type="number" step="0.01" name="max_cash" value="{{ $bonded->max_cash }}" class="w-full bg-white dark:bg-gray-900 border rounded px-2 py-1 text-sm text-right" />
                                    </td>

                                    <td class="px-4 py-3 text-right">
                                        <span x-show="!editing">{{ $bonded->effective_date }}</span>
                                        <input x-show="editing" type="date" name="effective_date" value="{{ $bonded->effective_date }}" class="w-full bg-white dark:bg-gray-900 border rounded px-2 py-1 text-sm text-right" />
                                    </td>

                                    <td class="px-4 py-3 text-right">
                                        <span x-show="!editing">{{ $bonded->expiration_date }}</span>
                                        <input x-show="editing" type="date" name="expiration_date" value="{{ $bonded->expiration_date }}" class="w-full bg-white dark:bg-gray-900 border rounded px-2 py-1 text-sm text-right" />
                                    </td>

                                    <td class="px-4 py-3 text-right">
                                        {{ $bonded->aging }}
                                    </td>

                                    <td class="px-4 py-3 text-right">
                                        <span x-show="!editing">{{ number_format($bonded->unliquidated_amount, 2) }}</span>
                                        <input x-show="editing" type="number" step="0.01" name="unliquidated_amount" value="{{ $bonded->unliquidated_amount }}" class="w-full bg-white dark:bg-gray-900 border rounded px-2 py-1 text-sm text-right" />
                                    </td>

                                    <td class="px-4 py-3">{{ $bonded->sdo->email }}</td>
                                    <td class="px-4 py-3">{{ $bonded->sdo->corporate_email }}</td>

                                    <td class="px-4 py-3 text-right">
                                        <span x-show="!editing">{{ $bonded->date_received_accounting }}</span>
                                        <input x-show="editing" type="date" name="date_received_accounting" value="{{ $bonded->date_received_accounting }}" class="w-full bg-white dark:bg-gray-900 border rounded px-2 py-1 text-sm text-right" />
                                    </td>

                                    <td class="px-4 py-3 text-right">
                                        <span x-show="!editing">{{ $bonded->date_complied }}</span>
                                        <input x-show="editing" type="date" name="date_complied" value="{{ $bonded->date_complied }}" class="w-full bg-white dark:bg-gray-900 border rounded px-2 py-1 text-sm text-right" />
                                    </td>

                                    <td class="px-4 py-3 text-right">
                                        <span x-show="!editing">{{ $bonded->compliance_date_returned }}</span>
                                        <input x-show="editing" type="date" name="compliance_date_returned" value="{{ $bonded->compliance_date_returned }}" class="w-full bg-white dark:bg-gray-900 border rounded px-2 py-1 text-sm text-right" />
                                    </td>

                                    <td class="px-4 py-3 text-center">
                                        <div class="flex items-center justify-center space-x-2">
                                            <button type="button" x-show="!editing" @click="editing = true" class="text-blue-600 hover:underline text-sm">Edit</button>
                                            <button type="submit" x-show="editing" class="text-green-600 hover:underline text-sm">Save</button>
                                            <button type="button" x-show="editing" @click="editing = false" class="text-gray-500 hover:underline text-sm">Cancel</button>
                                        </div>
                                    </td>
                                </tr>
                            </form>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <p class="text-sm text-gray-500 mt-3 italic">
                Scroll horizontally → to view all columns
            </p>

            <div class="mt-6">
                {{ $officials->appends(request()->query())->links() }}

            </div>
        </div>
    </div>
</x-app-layout>
