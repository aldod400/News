<x-mail::message>
# رسالة جديدة من موقع {{ config('app.name') }}

تم استلام رسالة جديدة من خلال نموذج الاتصال:

**الاسم:** {{ $contactMessage->name }}  
**البريد الإلكتروني:** {{ $contactMessage->email }}  
@if($contactMessage->phone)
**رقم الهاتف:** {{ $contactMessage->phone }}  
@endif
**الموضوع:** {{ $contactMessage->subject }}

**الرسالة:**
{{ $contactMessage->message }}

---

**معلومات إضافية:**
- **تاريخ الإرسال:** {{ $contactMessage->created_at->format('Y-m-d H:i:s') }}
- **عنوان IP:** {{ $contactMessage->ip_address }}

<x-mail::button :url="url('/admin/contact-messages/' . $contactMessage->id)">
عرض الرسالة في لوحة التحكم
</x-mail::button>

يمكنك الرد على هذه الرسالة مباشرة عن طريق الرد على هذا الإيميل.

شكراً،<br>
{{ config('app.name') }}
</x-mail::message>
