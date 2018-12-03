@extends('layouts.app')
@section('content')

    <div class="grid-system">
        <div class="horz-grid">
            @if(empty($permission))
                {!! BootForm::open([
                    'url'=>route('permissions.store'),
                    ]) !!}
            @else
                {!! BootForm::open([
                    'url'=>route('permissions.update',$permission->id),
                    'model'=>$permission,
                    'method'=>'put'
                    ]) !!}
            @endif
            {!!BootForm::text('name','Nama Permission')!!}
            {!!BootForm::text('display_name','Nama Display ')!!}
            {!!BootForm::textarea('description','Deskripsi')!!}
            {!!BootForm::submit('save')!!}
            {!!BootForm::close()!!}
        </div>
    </div>
@endsection

