@component('mail::layout')

@slot('header')
@component('mail::header')
    <img src="https://i.imgur.com/mM4YP1p.png" width="70" style="border-radius:10px;">
    <div style="font-size:22px; font-weight:bold; margin-top:8px; color:white;">
        BasketGO
    </div>
@endcomponent
@endslot

{{ $slot }}

@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

@slot('footer')
@component('mail::footer')
<div style="color:white; opacity:0.9;">
© {{ date('Y') }} BasketGO — All Rights Reserved  
<br>
🏀 Lapangan Terbaik, Booking Termudah
</div>
@endcomponent
@endslot

@endcomponent
