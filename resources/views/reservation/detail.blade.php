@extends('layouts.app')

@section('content')
    <div class="grid-system">
        <div class="horz-grid">
            <div class="row">
                <div class="col-md-6">
                    <u><h3>Meeting Detail</h3></u>
                    <b>Subject :</b>
                    {{$data->subject}}</td><br>
                    <b>Description</b>
                    <br>
                   {!! $data->description !!}
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <u><h3>Contact Person</h3></u>
                        <b>Name :</b>
                        {{$data->user->name}}
                        <br>
                        <b>E-Mail :</b>
                        {{$data->contact_email}}
                        <br>
                        <b>Manager-Mail :</b>
                        {{$data->manager_email}}
                        <br>
                        <h2>Status</h2>
                        <h3>{{$data->status}}</h3>
                        @if($data->status=='reject')
                            <b>Rejected :</b>
                            {{$data->reason}}
                        @endif
                        <br>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
@endsection
