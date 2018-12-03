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
                {{Html::link('/rooms','List Room',['class'=>'btn btn-primary'])}}
                <div class="grid-hor">
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped pagination" id="table">
                            <thead>
                            <tr>
                                <th>Name Area</th>
                                <th>Unit</th>
                                <th>Name Room</th>
                                <th>Description</th>
                                <th>Capacity</th>
                                <th>Contact Name</th>
                                <th>Contact Email</th>
                                <th>Contact Hp</th>
                                <th>Photo</th>
                                <th>Status</th>
                                <th>Restore</th>
                                <th>Delete Permanent</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rooms as $d)
                                <tr>
                                    <td>{{$d->area->name}}</td>
                                    <td>{{$d->area->unit->name}}</td>
                                    <td>{{$d->name}}</td>
                                    <td>{{$d->description}}</td>
                                    <td>{{$d->capacity}} orang</td>
                                    <td>{{$d->contact_name}}</td>
                                    <td>{{$d->contact_email}}</td>
                                    <td>{{$d->contact_hp}}</td>
                                    <td>
                                        @if(empty($d->photo))
                                            <img src="https://via.placeholder.com/100" style="border-radius:50%"/>
                                        @else
                                            <img src="{{asset('img/'.$d->photo)}}" class="img-responsive" style="height: 100px; width: 100px;border-radius:50%" alt="">
                                        @endif

                                    </td>
                                    @if($d->is_active == 1)
                                        <td>
                                            <label class="label label-default">Tersedia</label>
                                        </td>
                                    @else
                                        <td>
                                            <label class="label label-info">Tidak Tersedia </label>
                                        </td>
                                    @endif
                                    <td>
                                        {{Html::link(route('rooms.restore', $d->id), 'Restore',['class'=>'btn btn-warning btn-md pull-right']) }}
                                    </td>
                                    <td>
                                        {{Html::link(route('rooms.perma_del', $d->id), 'Delete Permanent',['class'=>'btn btn-danger btn-md pull-right']) }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
                "columnDefs": [{"orderable": false, "targets": [8, 9, 10]}],
            });

        });
    </script>
@endsection