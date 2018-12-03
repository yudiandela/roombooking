@extends('layouts.app')
@section('content')
    @if (session('alertedit'))
        <script type="text/javascript">
            swal("Good job!", "Success", "success");
        </script>
    @endif
    <br>
    <div class="profile-bottom">
        <h3><i class="fa fa-user"></i>Profile</h3>
        <div class="profile-bottom-top">
            <div class="col-md-4 profile-bottom-img">
            @if(empty($data->photo))
            <img src="https://via.placeholder.com/150" />
            @else
            {{Html::image('img/'.$data->photo)}}
            @endif
                <!-- <img src="{{asset('img/'.$data->photo)}}" class="img-responsive" style="height: 150px; width: 150px" alt=""> -->

            </div>
            <div class="col-md-8 profile-text">
                <h6>{{$data->name}}</h6>
                <table>
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td>{{$data->name}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td> :</td>
                        <td><a href="#">{{$data->email}}</a></td>
                    </tr>
                    <tr>
                        <td>Unit</td>
                        <td> :</td>
                        <td>
                            @if($data->unit_id == null)
                                update unit
                            @else
                                {{$data->unit->name}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Role</td>
                        <td>:</td>
                        <td>@foreach($roles as $role)
                                @if ($data->hasRole($role['name']))
                                    <h8>
                                        <label class="label label-info">  {{ $role['display_name'] }}</label>
                                    </h8>
                                @endif
                            @endforeach</td>

                    </tr>
                </table>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="profile-bottom-bottom">
        </div>
        <div class="profile-btn">
            <a href=""
               data-target="#modalEdit{{ $data->id }}"
               data-toggle="modal" id="modal-edit" title="Edit">
                <button class="btn bg-red">Update Profile</button>
            </a>
            <div class="clearfix"></div>
        </div>
    </div>
    <br>
    {{--modal update profile--}}
    <div class="modal fade" id="modalEdit{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h2 class="modal-title">Update Profile</h2>
                </div>
                <div class="modal-body">
                    {!! BootForm::open([
                    'url'=>route('users.updateProfile',$data->id),
                    'model'=>$data,
                    'method'=>'put',
                    'files'=>'true'
                    ]) !!}
                    {!!BootForm::text('name','Nama ')!!}
                    {!!BootForm::email('email','E-Mail ')!!}
                    {!!BootForm::select('unit_id','Pilih Unit',$select) !!}
                    <h4>Upload Foto</h4>
                    <input type="file" id="photo" name="photo" onchange="loadFile(event)"/>
                    
                    <img id="output" src="{{ empty($data) ? '#' : url('img/'. $data->photo ) }}" style="height: 70px; width: 70px; border-radius:50%;
vertical-align: middle;" alt="Foto anda" />


                </div>
                <div class="modal-footer">
                    {!!BootForm::submit('Update')!!}
                    {!!BootForm::close()!!}
                </div>
            </div>
        </div>
    </div>
    <script>
           var loadFile = function(event) {
           var reader = new FileReader();
           reader.onload = function(){
           var output = document.getElementById('output');
           output.src = reader.result;
         };
           reader.readAsDataURL(event.target.files[0]);
      };
    </script>
@endsection

