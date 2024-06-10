<x-mail::message>
# Introduction

Order status: {{ $order->status }}

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
