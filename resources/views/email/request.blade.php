@component('mail::message')
Min ada request room nih, dengan detail sebagai berikut : <br>
Area : {!! $area !!} <br>
Room :{!! $room !!} <br>
Tanggal : {!! $date !!} <br>
Subject :<br> {!! $sub !!}

@component('mail::button', ['url' => url('/reservation/approve/'.$id)])
Approve
@endcomponent

{{--@component('mail::button', ['url' => ''])--}}
{{--Reject--}}
{{--@endcomponent--}}


@endcomponent