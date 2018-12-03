@extends('layouts.app')
@section('content')
    <div class="panel-body">
        <div class="grid-system">
            <div class="horz-grid">
                <h4>Select Area/Building</h4>
                <div class="grid-hor">
                    <div class="row">
                        <div class="col-xs-12">
                            @foreach($area as $areas)
                                <div class="col-xs-4">
                                    {{Html::link(route('reservation.room', $areas->id), $areas->name,['class'=>'btn btn-primary btn-md pull-right',
                                    'style'=>'height: 100%;width: 100%;margin: 10px; padding: 40px;'
                                    ]) }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection