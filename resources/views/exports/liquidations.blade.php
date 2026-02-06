<table>
    <tr>
        <th colspan="2" style="background:#305496; color:white; text-align:center;">
            Cash Advance Details
        </th>
    </tr>
    <tr><td><strong>SDO Name:</strong></td><td>{{ optional($cashAdvance->sdo)->name }}</td></tr>
    <tr><td><strong>Particulars:</strong></td><td>{{ $cashAdvance->particulars }}</td></tr>
    <tr><td><strong>PAP:</strong></td><td>{{ optional($cashAdvance->papData)->pap_name }}</td></tr>
    <tr><td><strong>Transaction Type:</strong></td><td>{{ $cashAdvance->transaction_type }}</td></tr>
    <tr><td><strong>Check Number:</strong></td><td>{{ $cashAdvance->check_number }}</td></tr>
    <tr><td><strong>Check Date:</strong></td><td>{{ $cashAdvance->check_date ? \Carbon\Carbon::parse($cashAdvance->check_date)->format('m/d/Y') : '' }}</td></tr>
    <tr><td><strong>DV Number:</strong></td><td>{{ $cashAdvance->dv_number }}</td></tr>
    <tr><td><strong>DV Date:</strong></td><td>{{ $cashAdvance->dv_date ? \Carbon\Carbon::parse($cashAdvance->dv_date)->format('m/d/Y') : '' }}</td></tr>
    <tr><td><strong>ORS Number:</strong></td><td>{{ $cashAdvance->ors_number }}</td></tr>
    <tr><td><strong>ORS Date:</strong></td><td>{{ $cashAdvance->ors_date ? \Carbon\Carbon::parse($cashAdvance->ors_date)->format('m/d/Y') : '' }}</td></tr>
    <tr><td><strong>Payout Start:</strong></td><td>{{ $cashAdvance->payout_start ? \Carbon\Carbon::parse($cashAdvance->payout_start)->format('m/d/Y') : '' }}</td></tr>
    <tr><td><strong>Payout End:</strong></td><td>{{ $cashAdvance->payout_end ? \Carbon\Carbon::parse($cashAdvance->payout_end)->format('m/d/Y') : '' }}</td></tr>
    <tr>
        <td><strong>Due Date:</strong></td>
        <td>
            @if($cashAdvance->payout_end)
                {{ \Carbon\Carbon::parse($cashAdvance->payout_end)->addDays(31)->format('m/d/Y') }}
            @endif
        </td>
    </tr>
    <tr><td><strong>Granted Amount:</strong></td><td>{{ number_format($cashAdvance->granted_amount, 2) }}</td></tr>
    <tr><td><strong>Total Liquidation Received:</strong></td>
    <td>{{ number_format($cashAdvance->total_liquidated ?? 0, 2) }}</td></tr>

    <tr><td><strong>Total Pre-Audited:</strong></td>
        <td>{{ number_format($cashAdvance->total_pre_audited ?? 0, 2) }}</td></tr>

    <tr><td><strong>Total For Compliance:</strong></td>
        <td>{{ number_format($cashAdvance->total_for_compliance ?? 0, 2) }}</td></tr>

    <tr><td><strong>Total Refund:</strong></td>
        <td>{{ number_format($cashAdvance->total_refund ?? 0, 2) }}</td></tr>
</table>


<br>

<table>
    <tr>
        <th colspan="12" style="background:#305496; color:white; text-align:center;">
            Liquidations
        </th>
    </tr>
    <tr>
        <th>Liquidation Type</th>
        <th>Liquidated Amount</th>
        <th>For Compliance Amount</th>
        <th>Pre-Audited Amount</th>
        <th>Running Balance</th>
        <th>Liq Date Received</th>
        <th>Liq Number</th>
        <th>Liq Date</th>
        <th>OR Number</th>
        <th>OR Date</th>
        <!-- <th>Pre-Auditor</th> -->
        <th>JEV Number</th>
    </tr>

    @php
        // Starting balance = granted amount
        $runningBalance = $cashAdvance->granted_amount ?? 0;
    @endphp

    @foreach($liquidations as $liquidation)
        @php
            // Subtract this liquidation's pre-audited amount (use 0 if null)
            $deduction = $liquidation->pre_audited_amount ?? 0;
            $runningBalance -= $deduction;
        @endphp
        <tr>
            <td>{{ $liquidation->liquidation_type }}</td>
            <td>{{ number_format(abs($liquidation->for_liquidation_amount ?? 0), 2) }}</td>
            <td>
                ({{ number_format(abs($liquidation->for_compliance_amount ?? 0), 2) }})
            </td>
            <td>{{ number_format($liquidation->pre_audited_amount ?? 0, 2) }}</td>
            <td>{{ number_format($runningBalance, 2) }}</td>
            <td>{{ $liquidation->liq_date_received ? \Carbon\Carbon::parse($liquidation->liq_date_received)->format('Y-m-d') : '' }}</td>
            <td>{{ $liquidation->liq_number }}</td>
            <td>{{ $liquidation->liq_date ? \Carbon\Carbon::parse($liquidation->liq_date)->format('Y-m-d') : '' }}</td>
            <td>{{ $liquidation->or_number }}</td>
            <td>{{ $liquidation->or_date ? \Carbon\Carbon::parse($liquidation->or_date)->format('Y-m-d') : '' }}</td>
            <!-- <td>{{ $liquidation->pre_auditor }}</td> -->
            <td>{{ $liquidation->jev_no }}</td>
        </tr>
    @endforeach
</table>
