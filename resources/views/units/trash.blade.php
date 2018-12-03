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
                {{Html::link('/units','List Unit',['class'=>'btn btn-primary'])}}
                <div class="grid-hor">
                    <div class="content table-responsive table-full-width">
                        <div class="col col-md-7">
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <td>Name</td>
                                        <td>Restore</td>
                                        <td>Delete Permanent</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($units as $d)
                                        <tr>
                                            <td>{{$d->name}}</td>
                                            <td>
                                                {{Html::link(route('units.restore', $d->id), 'Restore',['class'=>'btn btn-warning btn-md pull-right']) }}
                                            </td>
                                            <td>
                                                {{Html::link(route('units.perma_del', $d->id), 'Delete Permanent',['class'=>'btn btn-danger btn-md pull-right']) }}
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