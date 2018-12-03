@component('mail::message')
    Dear {{ $name }}<br>
    Request room anda dengan detail sebagai berkikut : <br>
    Area : {!! $area !!} <br>
    Room : {!! $room !!} <br>
    Tanggal : {!! $date !!}<br>
    Subject : {!! $sub !!}<br>
    Sedang di proses oleh admin, Mohon kesediannya untuk menunggu.<br>
    <br>
    <br>
    Terimakasih,<br>
    <br>
    Admin MRBS
@endcomponent
