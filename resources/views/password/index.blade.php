@extends('layouts.app')
@section('content')
    <div class="grid-system">
        <div class="horz-grid">
            <h3 id="forms-example" class="">Update Password</h3>
            <div class="panel-body">
                @if (Session::has('success'))
                    <div class="alert alert-success">{!! Session::get('success') !!}</div>
                @endif
                @if (Session::has('failure'))
                    <div class="alert alert-danger">{!! Session::get('failure') !!}</div>
                @endif
                <form action="{{ route('password.update') }}" method="post" role="form" class="form-horizontal">
                    {{csrf_field()}}
                    <div class="form-group {{$errors->has('old')}}" >
                        <label class="col-md-2 control-label">Old Password</label>
                        <div class="col-md-8">
                            <div class="input-group input-icon right">
									<span class="input-group-addon">
										<i class="fa fa-key"></i>
									</span>
                                <input type="password" class="form-control1" placeholder="Old Password" name="old">
                                @if ($errors->has('old'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('old') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('password')}}">
                        <label class="col-md-2 control-label">New Password</label>
                        <div class="col-md-8">
                            <div class="input-group input-icon right">
									<span class="input-group-addon">
										<i class="fa fa-key"></i>
									</span>
                                <input type="password" class="form-control1" placeholder="Password" name="password">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label">Confirm Password</label>
                        <div class="col-md-8">
                            <div class="input-group input-icon right">
									<span class="input-group-addon">
										<i class="fa fa-key"></i>
									</span>
                                <input type="password" class="form-control1" placeholder="Confirm Password" name="password_confirmation">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col col-md-offset-9">
                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
@endsection