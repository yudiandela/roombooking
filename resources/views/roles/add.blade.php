@extends('layouts.app')
@section('content')

    <div class="grid-system">
        <div class="horz-grid">
            @if(empty($role))
                {!! BootForm::open([
                    'url'=>route('roles.store'),
                    ]) !!}
                {!! BootForm::label('Permissions') !!}
                {!!BootForm::checkboxes('permission[]',null,$permissions,'',['multiple'=>true]) !!}
            @else
                {!! BootForm::open([
                    'url'=>route('roles.update',$role->id),
                    'model'=>$role,
                    'method'=>'put'
                    ]) !!}
                {!! BootForm::label('Role') !!}
                {!!BootForm::checkboxes('permission[]',null,$allPermissions,$assignedPermissions,['multiple'=>true]) !!}
            @endif
            {!!BootForm::text('name','Nama Role')!!}
            {!!BootForm::text('display_name','Nama Display ')!!}
            {!!BootForm::textarea('description','Deskripsi')!!}

            {!!BootForm::submit('save')!!}
            {!!BootForm::close()!!}
        </div>
    </div>
@endsection

