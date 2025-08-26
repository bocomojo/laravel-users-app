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
    <tr><td><strong>Check Date:</strong></td><td>{{ \Carbon\Carbon::parse($cashAdvance->check_date)->format('Y-m-d') }}</td></tr>
    <tr><td><strong>DV Number:</strong></td><td>{{ $cashAdvance->dv_number }}</td></tr>
    <tr><td><strong>DV Date:</strong></td><td>{{ \Carbon\Carbon::parse($cashAdvance->dv_date)->format('Y-m-d') }}</td></tr>
    <tr><td><strong>ORS Number:</strong></td><td>{{ $cashAdvance->ors_number }}</td></tr>
    <tr><td><strong>ORS Date:</strong></td><td>{{ \Carbon\Carbon::parse($cashAdvance->ors_date)->format('Y-m-d') }}</td></tr>
    <tr><td><strong>Payout Start:</strong></td><td>{{ \Carbon\Carbon::parse($cashAdvance->payout_start)->format('Y-m-d') }}</td></tr>
    <tr><td><strong>Payout End:</strong></td><td>{{ \Carbon\Carbon::parse($cashAdvance->payout_end)->format('Y-m-d') }}</td></tr>
    <tr><td><strong>Granted Amount:</strong></td><td>{{ number_format($cashAdvance->granted_amount, 2) }}</td></tr>
    <tr><td><strong>Pre-Auditor:</strong></td><td>{{ $cashAdvance->pre_auditor }}</td></tr>
    <tr><td><strong>JEV Number:</strong></td><td>{{ $cashAdvance->jev_no }}</td></tr>
    <tr><td><strong>Created At:</strong></td><td>{{ \Carbon\Carbon::parse($cashAdvance->created_at)->format('Y-m-d') }}</td></tr>
</table>

<br>

<table>
    <tr>
        <th colspan="11" style="background:#305496; color:white; text-align:center;">
            Liquidation Entries
        </th>
    </tr>
    <tr>
        <th>Liquidation Type</th>
        <th>Granted Amount</th>
        <th>Liquidated Amount</th>
        <th>Liq Date Received</th>
        <th>Liq Number</th>
        <th>Liq Date</th>
        <th>OR Number</th>
        <th>OR Date</th>
        <th>Pre-Auditor</th>
        <th>JEV Number</th>
        <th>Created At</th>
    </tr>
    @foreach($liquidations as $liquidation)
    <tr>
        <td>{{ $liquidation->liquidation_type }}</td>
        <td>{{ number_format($liquidation->granted_amount, 2) }}</td>
        <td>{{ number_format($liquidation->for_liquidation_amount, 2) }}</td>
        <td>{{ optional($liquidation->liq_date_received) ? \Carbon\Carbon::parse($liquidation->liq_date_received)->format('Y-m-d') : '' }}</td>
        <td>{{ $liquidation->liq_number }}</td>
        <td>{{ optional($liquidation->liq_date) ? \Carbon\Carbon::parse($liquidation->liq_date)->format('Y-m-d') : '' }}</td>
        <td>{{ $liquidation->or_number }}</td>
        <td>{{ optional($liquidation->or_date) ? \Carbon\Carbon::parse($liquidation->or_date)->format('Y-m-d') : '' }}</td>
        <td>{{ $liquidation->pre_auditor }}</td>
        <td>{{ $liquidation->jev_no }}</td>
        <td>{{ optional($liquidation->created_at) ? \Carbon\Carbon::parse($liquidation->created_at)->format('Y-m-d') : '' }}</td>
    </tr>
    @endforeach
</table>
