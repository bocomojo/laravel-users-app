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
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th>NAME</th>
                                <th>POSITION</th>
                                <th>OFFICIAL STATION</th>
                                <th>EMPLOYMENT STATUS</th>
                                <th>STATUS</th>
                                <th>APPROVED AMOUNT OF BOND</th>
                                <th>MAX CASH ACCOUNTABILITY</th>
                                <th>EFFECTIVITY DATE</th>
                                <th>EXPIRATION DATE</th>
                                <th>DAYS BEFORE EXPIRATION</th>
                                <th>UNLIQUIDATED AMOUNT</th>
                                <th>EMAIL</th>
                                <th>CORPORATE EMAIL</th>
                                <th>DATE RECEIVED IN ACCOUNTING</th>
                                <th>DATE COMPLIED</th>
                                <th>COMPLIANCE (DATE RETURNED)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (officials as $bonded)
                                <tr>
                                    <td>{{ $bonded->sdo->name }}</td>
                                    <td>{{ $bonded->sdo->position }}</td>
                                    <td>{{ $bonded->sdo->official_station }}</td>
                                    <td>{{ $bonded->sdo->employment_status }}</td>
                                    <td>{{ $bonded->bond_status }}</td>
                                    <td>{{ number_format($bonded->approved_bond_amount, 2) }}</td>
                                    <td>{{ number_format($bonded->max_cash, 2) }}</td>
                                    <td>{{ $bonded->effective_date }}</td>
                                    <td>{{ $bonded->expiration_date }}</td>
                                    <td>{{ $bonded->aging }}</td>
                                    <td>{{ number_format($bonded->unliquidated_amount, 2) }}</td>
                                    <td>{{ $bonded->sdo->email }}</td>
                                    <td>{{ $bonded->sdo->corporate_email }}</td>
                                    <td>{{ $bonded->date_received_accounting }}</td>
                                    <td>{{ $bonded->date_complied }}</td>
                                    <td>{{ $bonded->compliance_date_returned }}</td>
                                </tr>
                            @endforeach
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
