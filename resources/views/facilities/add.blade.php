
@extends('layouts.app')
@section('content')

    <div class="grid-system">
        <div class="horz-grid">
            @if(empty($facility))
                {!! BootForm::open([
                    'url'=>route('facilities.store'),
                    ]) !!}
            @else
                {!! BootForm::open([
                    'url'=>route('facilities.update',$facility->id),
                    'model'=>$facility,
                    'method'=>'put'
                    ]) !!}
            @endif
          
            <!-- <div class="col-md-12">
                    {!!BootForm::select('room_id','Ruangan', $select) !!}
            </div> -->
            <div class="col-md-12">
            {!!BootForm::text('name','Nama Barang')!!}
            </div>
            {!!BootForm::submit('save')!!}
            {!!BootForm::close()!!}
        </div>
    </div>
@endsection

                