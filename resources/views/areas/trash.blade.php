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
                {{Html::link('/areas','List Area',['class'=>'btn btn-primary'])}}
                <div class="grid-hor">
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped" id="table">
                            <thead>
                            <tr>
                                <th>Name Area</th>
                                <th>Description</th>
                                <th>Count Room</th>
                                <th>Unit</th>
                                <th>Create At</th>
                                <th>Update At</th>
                                <th>Restore</th>
                                <th>Delete Permanent</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($areas as $d)
                                <tr>
                                    <td>{{$d->name}}</td>
                                    <td>{{$d->description}}</td>
                                    <td>{{count($d->rooms)}}</td>
                                    <td>{{$d->unit->name}}</td>
                                    <td>{{$d->created_at}}</td>
                                    <td>{{$d->updated_at}}</td>

                                    <th>
                                        {{Html::link(route('areas.restore', $d->id), 'Restore',['class'=>'btn btn-warning btn-md pull-right']) }}
                                    </th>
                                    <td>
                                        {{Html::link(route('areas.perma_del', $d->id), 'Delete Permanent',['class'=>'btn btn-danger btn-md pull-right']) }}
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
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.table').DataTable({
                "pageLength": 4,
                "lengthMenu": [[4, 10, 15, 25, 50, -1], [4, 10, 15, 25, 50, "All"]],
                "order": [[0, "asc"], [1, "asc"]],
                "columnDefs": [{"orderable": false, "targets": [6, 7]}],
            });
        });
    </script>
@endsection