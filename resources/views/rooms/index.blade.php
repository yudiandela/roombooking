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
                {{Html::link('/rooms/add','+ Add Room',['class'=>'btn btn-primary'])}}
                {{Html::link('/rooms/trash','- Trash',['class'=>'btn btn-primary'])}}
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
                                <th>fasilitas</th>
                                <th>Photo</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($data as $datas=>$d)
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
                                        {{-- {{ $d->facility['name'] }} --}}
                                        {{$d->facility->name}}
                                    {{-- @foreach($facilities as $facility)
                                        @if($data[$datas]->hasFacility($facility['name']))
                                        <ul>
                                            <li>
                                            {{ $facility['name'] }}
                                            </li>
                                        </ul>
                                        @endif
                                    @endforeach --}}
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
                                        {{Html::link(route('rooms.edit', $d->id), 'Edit',['class'=>'btn btn-warning btn-md pull-right']) }}
                                    </td>
                                    <th>
                                        <a href="{{route('rooms.delete',$d->id)}}"
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
        {{--modal delete--}}
        @foreach($data as $d)
            <div class="modal fade" id="modalDelete{{$d->id}}" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h2 class="modal-title">Apakah yakin menghapus data Ruangan {{$d->name}}</h2>
                        </div>
                        <div class="modal-footer">
                            {!! Form::open(['route'=>['rooms.delete',$d->id]]) !!}
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
                "columnDefs": [{"orderable": false, "targets": [8, 9, 10]}],
            });

        });
    </script>
@endsection