<table style="border-collapse: collapse; width: 100%;">

    {{-- HEADER SECTION --}}
    <tr>
        <td><strong>FOR</strong></td>
        <td>:</td>
        <td colspan="3">ATTY. MARIA LOUELLA T. GIANAN</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td colspan="3">Audit Team Leader</td>
    </tr>
    <tr>
        <td><strong>FROM</strong></td>
        <td>:</td>
        <td colspan="3">THE REGIONAL ACCOUNTANT</td>
    </tr>
    <tr>
        <td><strong>SUBJECT</strong></td>
        <td>:</td>
        <td colspan="3">TRANSMITTAL OF LIQUIDATION REPORTS</td>
    </tr>
    <tr>
        <td><strong>DATE</strong></td>
        <td>:</td>
        <td colspan="3">{{ \Carbon\Carbon::now()->format('F d, Y') }}</td>
    </tr>

    <tr><td colspan="5" style="height:20px;"></td></tr>

    <tr>
        <td colspan="5">
            We are respectfully submitting the liquidation reports.
            Kindly refer to the attached summary for your reference.
        </td>
    </tr>

    <tr><td colspan="5" style="height:15px;"></td></tr>

    {{-- TABLE HEADER --}}
    <tr style="background-color:#e5e5e5; font-weight:bold; text-align:center;">
        <th style="border:1px solid #000; text-align:center;">No.</th>
        <th style="border:1px solid #000; text-align:center;">SUBSIDIARY LEDGER TITLE</th>
        <th style="border:1px solid #000; text-align:center;">AMOUNT</th>
        <th style="border:1px solid #000; text-align:center;">NO. OF FOLDER</th>
        <th style="border:1px solid #000; text-align:center; width:120px;">NO. OF SACKS</th>
    </tr>

    {{-- BODY --}}
    @php 
        $rowNumber = 1; 
    @endphp

    @foreach ($liquidationsBySack as $sackNumber => $group)
        <tbody style="border:2px solid #000; margin-bottom:5px;"> {{-- solid border around each sack --}}
            @foreach ($group as $index => $liq)
                <tr>
                    <td style="text-align:center; border:1px solid #000;">{{ $rowNumber++ }}</td>
                    <td style="border:1px solid #000;">{{ $liq->sdo_name ?? 'N/A' }}</td>
                    <td style="text-align:right; border:1px solid #000;">{{ number_format($liq->amount ?? 0, 2) }}</td>
                    <td style="text-align:center; border:1px solid #000;"></td>

                    {{-- Merge sack number --}}
                    @if ($index === 0)
                        <td rowspan="{{ $group->count() }}" style="text-align:center; vertical-align:middle; border:1px solid #000; width:120px;">
                            {{ $sackNumber }}
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    @endforeach

    {{-- TOTAL ROW --}}
    <tr style="font-weight:bold; background-color:#f2f2f2;"> {{-- subtle highlight --}}
        <td colspan="2" style="text-align:center; border:1px solid #000;">TOTAL</td>
        <td style="text-align:right; border:1px solid #000;">{{ number_format($totalAmount, 2) }}</td>
        <td style="text-align:center; border:1px solid #000;"></td>
        <td style="text-align:center; border:1px solid #000;">{{ $totalSacks }}</td>
    </tr>

    <tr><td colspan="5" style="height:30px;"></td></tr>

    {{-- SIGNATORY --}}
    <tr>
        <td colspan="3" style="text-align:left;">
            <strong>WENDY G. RANCES, CPA</strong><br>
            Accountant III
        </td>
    </tr>
    <tr>
        <td colspan="3" style="text-align:left;"></td>
    </tr>
    <tr>
        <td colspan="3" style="text-align:left;">
            hkeq/aaIII
        </td>
    </tr>

</table>
