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
        <div class="grid-system">
            <div class="horz-grid">
                {{Html::link('/areas/add','+ Add Area',['class'=>'btn btn-primary'])}}
                {{Html::link('/areas/trash','- Trash',['class'=>'btn btn-primary'])}}
                <div class="grid-hor">
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped" id="table" >
                            <thead>
                            <tr>
                                {{--<th>--}}
                                    {{--<input type="checkbox" name="select_all" value="1" id="table">--}}
                                {{--</th>--}}
                                <th>Name Area</th>
                                <th>Description</th>
                                <th>Count Room</th>
                                <th>Unit</th>
                                <th>Create At</th>
                                <th>Update At</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $d)
                                <tr>
                                    {{--<th>--}}
                                        {{--<input type="checkbox" name="select_all" value="1" id="example-select-all">--}}
                                    {{--</th>--}}
                                    <td>{{$d->name}}</td>
                                    <td>{{$d->description}}</td>
                                    <td>{{count($d->rooms)}}</td>
                                    <td>{{$d->unit->name}}</td>
                                    <td>{{$d->created_at}}</td>
                                    <td>{{$d->updated_at}}</td>
                                    <th>{{Html::link(route('areas.edit', $d->id), 'Edit',['class'=>'btn btn-warning btn-md pull-right']) }}</th>
                                    {{--<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Delete</button>--}}
                                    <th>
                                        <a href="{{route('areas.delete',$d->id)}}"
                                           data-target="#modalDelete{{ $d->id }}"
                                           data-toggle="modal" id="modal-edit" title="Edit">
                                            <button class="btn btn-danger btn-md">Delete</button>
                                        </a>
                                    </th>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{--<td>--}}
                            {{--{{Html::link(route('areas.mass_destroy', $d->id), 'Delete ',['class'=>'btn btn-danger btn-md pull-right']) }}--}}
                        {{--</td>--}}
                    </div>
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
                        <h2 class="modal-title">Apakah yakin menghapus data {{$d->name}}</h2>
                    </div>
                    <div class="modal-footer">
                        {!! Form::open(['route'=>['areas.delete',$d->id]]) !!}
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
                "columnDefs":
                    [{
                        "orderable": false,
                        "targets": [6, 7],
                    }],
            });
        });
    </script>
@endsection

