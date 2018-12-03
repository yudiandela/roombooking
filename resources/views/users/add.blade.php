@extends('layouts.app')
@section('content')

    <div class="grid-system">
        <div class="horz-grid">
            @if(empty($data))
                {!! BootForm::open([
                    'url'=>route('users.store'),
                    ]) !!}
            @else
                {!! BootForm::open([
                    'url'=>route('users.update',$data->id),
                    'model'=>$data,
                    'method'=>'put'
                    ]) !!}

            @endif
            {!!BootForm::text('name','Name ')!!}
            {!!BootForm::email('email','E-Mail ')!!}
               @if(empty($data))
                {!!BootForm::password('password','Password ')!!}
            @endif
            {!!BootForm::select('unit_id','Unit',$select) !!}
                @if(empty($data))
                    {!! BootForm::label('Role') !!}
                    {!!BootForm::checkboxes('role[]',null,$roles,'',['multiple'=>true]) !!}
                @else
                    {!! BootForm::label('Role') !!}
                    {!!BootForm::checkboxes('role[]',null,$allRoles,$assignedRoles,['multiple'=>true]) !!}
                @endif
             {!!BootForm::submit('Save')!!}
            {!!BootForm::close()!!}
        </div>
    </div>
@endsection

