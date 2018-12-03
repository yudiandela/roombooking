@extends('layouts.app')
@section('content')
    <div class="panel-body">
        @if (session('alert'))
            <div class="alert alert-success alert-dismissible">
                <a class="close" data-dismiss="alert" href="#">X</a>
                <h4 class="alert-heading">Sukses!</h4>
                {{ session('alert') }}
            </div>
        @endif
        @if (session('alertdel'))
            <div class="alert alert-danger alert-dismissible">
                <a class="close" data-dismiss="alert" href="#">X</a>
                <h4 class="alert-heading">Sukses!</h4>
                {{ session('alertdel') }}
            </div>
        @endif
        @if (session('alertedit'))
            <div class="alert alert-info alert-dismissible">
                <a class="close" data-dismiss="alert" href="#">X</a>
                <h4 class="alert-heading">Sukses!</h4>
                {{ session('alertedit') }}
            </div>
        @endif
            @if (session('alertError'))
                <div class="alert alert-danger alert-error">
                    <a class="close" data-dismiss="alert" href="#">X</a>
                    <h4 class="alert-heading">Error!</h4>
                    {{ session('alertError') }}

                </div>
            @endif
        <div class="grid-system">
            <div class="horz-grid">
                {{Html::link('/users/add','+ Add User',['class'=>'btn btn-primary'])}}
                <div class="grid-hor">
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped " id="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>E-Mail</th>
                                <th>Unit</th>
                                <th>Role</th>
                                <th>Photo</th>
                                <th>Create At</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $i=>$d)
                                <tr>
                                    <td>{{$d->name}}</td>
                                    <td>{{$d->email}}</td>
                                    @if($d->unit_id == null)
                                        <td> update unit</td>
                                    @else
                                        <td>{{$d->unit->name}}</td>
                                    @endif
                                    <td>
                                        @foreach($roles as $role)
                                            @if ($data[$i]->hasRole($role['name']))
                                                <h8>
                                                    <label class="label label-info">  {{ $role['display_name'] }}</label>
                                                </h8>
                                            @endif
                                        @endforeach
                                    </td>
                                  
                                    <td>
                                    @if(empty($d->photo))
                                        <img src="https://via.placeholder.com/100" class="img-responsive" style="height: 100px; width: 100px;border-radius:50%" alt=""/>
                                    @else
                         
                                    <img src="{{asset('img/'.$d->photo)}}" class="img-responsive" style="height: 100px; width: 100px;border-radius:50%" alt="">
                                    @endif
                                    </td>
                                   
                                    <td>{{$d->created_at}}</td>
                                    <th>{{Html::link(route('users.edit', $d->id), 'Edit',['class'=>'btn btn-info']) }}</th>
                                    <th>
                                        <a href="{{route('users.destroy',$d->id)}}"
                                           data-target="#modalDelete{{ $d->id }}"
                                           data-toggle="modal" id="modal-edit" title="Edit">
                                            <button class="btn btn-danger btn-md">Delete</button>
                                        </a>
                                    </th>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--modal delete--}}
    @foreach($data as $d)
        <div class="modal fade" id="modalDelete{{$d->id}}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="modal-title">Apakah yakin menghapus data User {{$d->name}}</h2>
                    </div>
                    <div class="modal-footer">
                        {!! Form::open(['route'=>['users.destroy',$d->id]]) !!}
                        {!! method_field('DELETE') !!}
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        {!! Form::submit('Delete',array('class'=>'btn btn-danger btn-md')) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        </div>
    @endforeach
    <script type="text/javascript">
        $(document).ready(function () {
            $('.table').DataTable({
                "pageLength": 4,
                "lengthMenu": [[4, 10, 15, 25, 50, -1], [4, 10, 15, 25, 50, "All"]],
                "order": [[0, "asc"], [1, "asc"]],
                "columnDefs": [{"orderable": false, "targets": [5, 6]}],
            });
        });
    </script>
@endsection