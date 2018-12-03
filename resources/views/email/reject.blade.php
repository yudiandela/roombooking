@component('mail::message')
    Dear {{ $name }}<br>
    Booking Room yang anda ajukan untuk tanggal : {{ $date }}<br>
    tidak bisa kami setujui dengan alasan sebagai berikut : <br>
    {!! $msg !!}


@endcomponent