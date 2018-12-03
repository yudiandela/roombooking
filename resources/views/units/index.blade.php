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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    + Add Unit
                </button>
                {{Html::link('/units/trash','- Trash',['class'=>'btn btn-primary'])}}
                <div class="grid-hor">
                    <div class="content table-responsive table-full-width">
                        <div class="col col-md-7">
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <td>Name</td>
                                        <td>Edit</td>
                                        <td>Delete</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $d)
                                        <tr>
                                            <td>{{$d->name}}</td>
                                            <td>
                                                <a href=""
                                                   data-target="#modalEdit{{ $d->id }}"
                                                   data-toggle="modal" id="modal-edit" title="Edit">
                                                    <button class="btn btn-warning btn-md pull-right">Edit</button>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{route('units.delete',$d->id)}}"
                                                   data-target="#modalDelete{{ $d->id }}"
                                                   data-toggle="modal" id="modal-delete" title="Delete">
                                                    <button class="btn btn-danger btn-md">Delete</button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal add -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h2 class="modal-title">Add Unit</h2>
                        </div>
                        <div class="modal-body">
                            {!! BootForm::open([
                                'url'=>route('units.store'),
                                ]) !!}
                            {!!BootForm::text('name','Name Unit')!!}
                        </div>
                        <div class="modal-footer">
                            {!!BootForm::submit('Save')!!}
                            {!!BootForm::close()!!}
                        </div>
                    </div>
                </div>
            </div>
            <!--end modal add -->

            <!--modal delete -->
            @foreach($data as $d)
                <div class="modal fade" id="modalDelete{{$d->id}}" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h2 class="modal-title">Apakah yakin menghapus data unit {{$d->name}}</h2>
                            </div>
                            <div class="modal-footer">
                                {!! Form::open(['route'=>['units.delete',$d->id]]) !!}
                                {!! method_field('DELETE') !!}
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                {!! Form::submit('Delete',array('class'=>'btn btn-danger btn-md')) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
        @endforeach
        <!--end modal delete -->
            <!-- modal edit -->
        @foreach($data as $d)
                <div class="modal fade" id="modalEdit{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h2 class="modal-title">Edit Unit</h2>
                            </div>
                            <div class="modal-body">
                                {!! BootForm::open([
                                    'url'=>route('units.update',$d->id),
                                    'model'=>$d,
                                    'method'=>'put'
                                    ]) !!}
                                {!!BootForm::text('name','Nama Unit')!!}
                            </div>
                            <div class="modal-footer">
                                {!!BootForm::submit('save')!!}
                                {!!BootForm::close()!!}
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.table').DataTable({
                "pageLength": 4,
                "lengthMenu": [[4, 10, 15, 25, 50, -1], [4, 10, 15, 25, 50, "All"]],
                "order": [[0, "asc"], [1, "asc"]],
                "columnDefs": [{"orderable": false, "targets": [1, 2]}],
            });
        });
    </script>

@endsection