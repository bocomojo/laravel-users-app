<x-mail::message>
# 📄 Compliance File - {{ $liquidation->liq_number ?? $liquidation->check_number }}

Hello,

We would like to inform you that a **new compliance file** has been sent for review.

**Liquidation Number:** {{ $liquidation->liq_number ?? $liquidation->check_number }}

You will find the related document attached to this email.  
Please review it at your earliest convenience.

---

Thanks & Best Regards,  
**Accounting - Liquidation Team**
</x-mail::message>