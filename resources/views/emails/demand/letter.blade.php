<x-mail::message>
# Demand for Liquidation

Dear {{ $advance->sdo->name }},

This is a formal reminder that your cash advance with the following details remains unliquidated past the 30-day deadline.

- **Check Number:** {{ $advance->check_number }}
- **Granted Amount:** ₱{{ number_format($advance->granted_amount, 2) }}
- **Remaining Balance:** ₱{{ number_format($advance->remaining_balance, 2) }}
- **Payout End Date:** {{ \Carbon\Carbon::parse($advance->payout_end)->format('F j, Y') }}

Please settle this amount immediately.

Thanks,<br>
Field Office V Accounting Unit
</x-mail::message>