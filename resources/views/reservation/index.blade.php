@extends('layouts.app')
@section('content')

    <link href="{{ asset('css/popup.css') }}" rel="stylesheet">
    <script>$(function ()
        {
// show popup
            $('.popup-show').click(function (e) {
                e.preventDefault();
                $('.popup').fadeIn();
            });
// close
            $('.bg,.close').click(function (e) {
                e.preventDefault();
                $('.popup').fadeOut('slow');
            });
        });
    </script>

    <style type="text/css">
        @media screen and (min-width: 768px) {
            .modal-dialog {
                width: 1000px; /* New width for default modal */
            }
            .modal-sm {
                width: 350px; /* New width for small modal */
            }
        }
        @media screen and (min-width: 992px) {
            .modal-lg {
                width: 950px; /* New width for large modal */
            }
        }
    </style>

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
                <div class="grid-hor">
                    <div class="content table-responsive table-full-width">
                        {!! BootForm::open([
                           'url'=>route('reservation.index'),
                           'model'=> $data,
                           'method' => 'get',
                       ]) !!}
                        <div class="col-sm-3">
                            <h4>List Of Reservation</h4>
                            {{Html::link('/reservation/addSchedule','+ Add Schedule',['class'=>'btn btn-primary'])}}
                        </div>
                        <br>
                        <br>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                    <input id="tgl_mulai" placeholder="yyyy-mm-dd" type="text"
                                           class="form-control datepicker" name="tgl_awal" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                    <input id="tgl_akhir" placeholder="yyyy-mm-dd" type="text"
                                           class="form-control datepicker" name="tgl_akhir" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            {!! BootForm::select('status', false, [
                                ''=>'All Status',
                                'pending'=>'Pending',
                                'approved'=>'Approved',
                                'reject'=>'Reject']) !!}
                        </div>
                        <div class="col-sm-2">
                            <div id="areas-container">
                                {!! BootForm::select('area', false, $area, null,
                                    ['onchange'=>'getRooms(this.value)']) !!}
                            </div>
                            <div id="loading"><i class="fa fa-spinner fa-spin"></i> Loading...</div>
                            <div id="rooms-container">
                                {!! BootForm::select('room', false, $room, null, [
                                    'id'=>'select-rooms']) !!}
                            </div>

                        </div>
                        <div class="col-sm-1">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>

                        {!! BootForm::close() !!}

                        <table class="table table-hover table-striped pagination" id="table">
                            <thead>
                            <tr>
                                <th>Requestor</th>
                                <th>Area</th>
                                <th>Room</th>
                                <th>Meeting Subject</th>
                                <th>Start</th>
                                <th>Contact Hp</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $d)
                                <tr>
                                    <td>{{$d->user->name}}</td>
                                    <td>{{$d->room->area->name}}</td>
                                    <td>{{$d->room->name}}</td>
                                    <td>{{$d->subject}}</td>
                                    <td>{{$d->start}} </td>
                                    <td>{{$d->contact_hp}}</td>
                                    <td>{{$d->status}}</td>


                                    {{--<td>--}}
                                    {{--{{Html::link(route('rooms.edit', $d->id), 'View') }}--}}
                                    {{--</td>--}}
                                    <td>
                                        <a href=""
                                           data-target="#modalEdit{{ $d->id }}"
                                           data-toggle="modal" id="modal-edit" title="Edit">
                                            <button class="btn btn-warning btn-md pull-right">view</button>
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
    @foreach($data as $d)
        <div class="modal fade" id="modalEdit{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true" style="display: none; ">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="modal-title">Detail</h2>
                    </div>

                    <div class="col col-md-6">
                        <u><h3>Meeting Detail</h3></u>
                        <b>Area  :</b>
                        {{$d->room->area->name}}
                        <br>
                        <b>Room :</b>
                        {{$d->room->name}}
                        <br>
                        <b>Subject :</b>
                        {{$d->subject}}
                        <br>
                        <b>Description</b>
                        <br>
                        {!! $d->description !!}
                    </div>
                    <div class="col col-md-6">
                        <u><h3>Contact Person</h3></u>
                        <b>Name :</b>
                        {{$d->user->name}}
                        <br>
                        <b>Unit  :</b>
                        {{$d->unit->name}}
                        <br>
                        <b>E-Mail :</b>
                        {{$d->contact_email}}
                        <br>
                        <b>Manager-Mail :</b>
                        {{$d->manager_email}}
                        <br>
                        <h2>Status</h2>
                        <h3>{{$d->status}}</h3>

                        @if($d->status=='reject')
                            <b>Rejected :</b>
                            {{$d->reason}}
                        @endif
                        <br>
                    </div>
                    <div class="modal-footer">
                        @if( $d->status == 'pending')
                            <div class="col-md-5">
                                {{Html::link(route('reservation.update', $d->id), 'approve',['class'=>'btn btn-info btn-fill pull']) }}
                            </div>
                            <button type="button" class="popup-show btn btn-warning btn-fill pull">Reject</button>
                            <div class="popup">
                                <div class="bg"></div>
                                <div class="content">
                                    <div class="col-md-5">
                                        <div class="content-header">
                                            <center><h4>Reason</h4></center>
                                        </div>
                                        <div class="content-text">
                                            <form class="form-horizontal" action="{{ URL('reservation/reject') }}"
                                                  method="GET">

                                                <div class="form-group row">
                                                    <label for="id" class="col-sm-1 col-form-label"></label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" type="hidden" name="id"
                                                               value="{{$d->id}}">
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" type="hidden" name="status"
                                                               value="reject">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="reason" class="col-sm-2 col-form-label"></label>
                                                    <div class="col-md-12 ">
                                                        <textarea type="input" name="reason" value=""
                                                                  class="form-control" id="reason"
                                                                  placeholder="isi alasan"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-raised btn-primary pull-right">
                                                        Submit
                                                    </button>
                                                </div>
                                            </form>

                                        </div>

                                    </div>
                                </div> @endif
                            </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

    @endforeach
    <script type="text/javascript">
        $(document).ready(function () {
            $('#table').dataTable({
                "pageLength": 4,
                "lengthMenu": [[4, 10, 15, 25, 50, -1], [4, 10, 15, 25, 50, "All"]],
                "order": [[0, 'asc'], [1, 'asc']]
            });

        });
    </script>
    <script type="text/javascript">

        //Select2
        $(document).ready(function () {
            $('#loading').hide();
            $("#rooms-container").hide();
        });

        //AJAX Mendapatkan Room berdasarkan Area
        function getRooms(areaId) {
            $.ajax({
                dataType: "html",
                url: "{{ route('ajax.rooms.byarea') }}",
                data: {
                    areaId: areaId
                },
                beforeSend: function () { //untuk membuat loading
                    $("#loading").show();
                },
                success: function (html) {
                    $("#select-rooms").html(html);
                    $("#rooms-container").show();
                    $("#loading").hide();
                }
            });
        }
    </script>
    <script type="text/javascript">
        $(function () {
            $(".datepicker").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
            });
            $("#tgl_mulai").on('changeDate', function (selected) {
                var startDate = new Date(selected.date.valueOf());
                $("#tgl_akhir").datepicker('setStartDate', startDate);
                if ($("#tgl_mulai").val() > $("#tgl_akhir").val()) {
                    $("#tgl_akhir").val($("#tgl_mulai").val());
                }
            });
        });
    </script>
@endsection
