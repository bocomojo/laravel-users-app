<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Bonded Officials') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="w-full px-4">
            <div class="bg-white dark:bg-gray-800 overflow-auto shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900 dark:text-gray-100">
                    <table class="w-full table-auto divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-100">
                            <tr>
                                <th class="px-4 py-2">NAME</th>
                                <th class="px-4 py-2">POSITION</th>
                                <th class="px-4 py-2">OFFICIAL STATION</th>
                                <th class="px-4 py-2">EMPLOYMENT STATUS</th>
                                <th class="px-4 py-2">STATUS</th>
                                <th class="px-4 py-2">APPROVED AMOUNT OF BOND</th>
                                <th class="px-4 py-2">MAX CASH ACCOUNTABILITY (SDO)</th>
                                <th class="px-4 py-2">EFFECTIVITY DATE</th>
                                <th class="px-4 py-2">EXPIRATION DATE</th>
                                <th class="px-4 py-2">REMARKS</th>
                                <th class="px-4 py-2">DAYS BEFORE EXPIRATION</th>
                                <th class="px-4 py-2">UNLIQUIDATED AMOUNT</th>
                                <th class="px-4 py-2">EMAIL</th>
                                <th class="px-4 py-2">CORPORATE EMAIL</th>
                                <th class="px-4 py-2">DATE RECEIVED IN ACCOUNTING</th>
                                <th class="px-4 py-2">REMARKS/STATUS</th>
                                <th class="px-4 py-2">DATE COMPLIED</th>
                                <th class="px-4 py-2">COMPLIANCE (DATE RETURNED)</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($officials as $official)
                                <tr>
                                    <td class="px-4 py-2">{{ $official->name }}</td>
                                    <td class="px-4 py-2">{{ $official->position }}</td>
                                    <td class="px-4 py-2">{{ $official->official_station }}</td>
                                    <td class="px-4 py-2">{{ $official->employment_status }}</td>
                                    <td class="px-4 py-2">{{ $official->status }}</td>
                                    <td class="px-4 py-2">₱{{ number_format($official->approved_bond_amount, 2) }}</td>
                                    <td class="px-4 py-2">₱{{ number_format($official->max_cash_accountability, 2) }}</td>
                                    <td class="px-4 py-2">{{ $official->effectivity_date }}</td>
                                    <td class="px-4 py-2">{{ $official->expiration_date }}</td>
                                    <td class="px-4 py-2">{{ $official->remarks }}</td>
                                    <td class="px-4 py-2">
                                        @php
                                            $daysLeft = \Carbon\Carbon::parse($official->expiration_date)->diffInDays(now(), false);
                                        @endphp
                                        {{ $daysLeft > 0 ? $daysLeft . ' days left' : 'Expired ' . abs($daysLeft) . ' days ago' }}
                                    </td>
                                    <td class="px-4 py-2">₱{{ number_format($official->unliquidated_amount, 2) }}</td>
                                    <td class="px-4 py-2">{{ $official->email }}</td>
                                    <td class="px-4 py-2">{{ $official->corporate_email }}</td>
                                    <td class="px-4 py-2">{{ $official->received_in_accounting }}</td>
                                    <td class="px-4 py-2">{{ $official->remarks_status }}</td>
                                    <td class="px-4 py-2">{{ $official->date_complied }}</td>
                                    <td class="px-4 py-2">{{ $official->compliance_returned }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="19" class="px-4 py-2 text-center text-gray-500 dark:text-gray-400">
                                        No bonded officials found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $officials->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
