@extends('layouts.app')
@section('content')
    <div class="panel-body">
        <div class="grid-system">
            <div class="horz-grid">
                {{--@foreach($area as $areas)--}}
                {{--<h4>Select Rooms at {{$areas->name}} </h4>--}}
                {{--@endforeach--}}
                <div class="grid-hor">
                    <div class="row">
                        <div class="col-xs-12">
                            @foreach($room as $rooms)
                                <div class="col-xs-4">
                                    <img src="{{asset('img/'.$rooms->photo)}}" class="img-responsive"
                                         style="height: 150px; width: 300px;  padding: 10px; border-radius: 20%" alt="">
                                    <div class="row-md-4" align="center">
                                        <a href="{{route('reservation.calendar', ['area_id'=>$rooms->area_id, 'room_id'=>$rooms->id]),$rooms->name,
                                    ['class'=>'btn btn-primary' ]}}">
                                            {{$rooms->name}}
                                        </a>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection