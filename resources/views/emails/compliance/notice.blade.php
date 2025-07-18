<x-mail::message>
@component('mail::message')
# Compliance File Submitted

A new compliance file has been submitted for:

**Liquidation Number:** {{ $liquidation->liq_number ?? $liquidation->check_number }}

Please see the attached file for review.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
</x-mail::message>
