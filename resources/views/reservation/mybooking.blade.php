@extends('layouts.app')
@section('content')

@role('employee')
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
                           'url'=>route('reservation.show'),
                           'model'=> $data,
                           'method' => 'get',

                       ]) !!}


                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class='input-group date' id='datetimepicker1'>
                                    <input type="text" class="form-control" id="start" name="start">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class='input-group date' id='datetimepicker2'>
                                    <input type="text" class="form-control" id="end" name="end">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            {!! BootForm::select('status', false, [
                                ''=>'All Status',
                                'pending'=>'Pending',
                                'approved'=>'Approved',
                                'reject'=>'Reject',
                                'cancel'=>'cancel',]) !!}
                        </div>
                        <div class="col-sm-3">
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

                        <div class="col-sm-2">
                            <button type="submit" name="qcari" class="btn btn-primary">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>

                        {!! BootForm::close() !!}

                        <table class="table table-hover table-striped pagination" id="table">
                        @role('employee')
                            <thead>
                            <tr>
                                <th>Requestor</th>
                                <th>Area</th>
                                <th>Room</th>
                                <th>Capacity</th>
                                <th>Meeting Subject</th>
                                <th>Start</th>
                                <th>Contact Hp</th>
                                <th>Status</th>
                                <th>Reason</th>
                                <th>Action</th>
                                
                                
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $d)
                                <tr>
                                    <td>{{$d->user->name}}</td>
                                    <td>{{$d->room->area->name}}</td>
                                    <td>{{$d->room->name}}</td>
                                    <td>{{$d->room->capacity}} orang</td>
                                    <td>{{$d->subject}}</td>
                                    <td>{{$d->start}} </td>
                                    <td>{{$d->contact_hp}}</td>
                                    <td>{{$d->status}}</td>
                                    @if($d->reason==!null)
                                    <td>{{$d->reason}}</td>
                                    @else
                                    <td>-</td>
                                @endif
                                    @if( $d->status == 'pending')
                                    <td>
                                   
                                    <a href=""
                                          data-target="#modalEdit{{ $d->id }}"
                                          data-toggle="modal" id="modal-edit" title="Edit">
                                        <button class="btn btn-warning btn-md pull-right">Cancel</button>
                                        </a>
                                    
                                    </td>  
                                    @else
                                        <td>-</td>
                                    @endif
                                                     
                                </tr>
                            @endforeach

                            </tbody>
                            @endrole
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @foreach($data as $d)
                <div class="modal fade" id="modalEdit{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h2 class="modal-title">Reason</h2>
                            </div>
                            <form class="form-horizontal" action="{{ route('reservation.cancel',$d->id) }}"
                                                  method="post">
                                                 
                                                <div class="form-group row">
                                                    <label for="id" class="col-sm-1 col-form-label"></label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" type="hidden" name="id"
                                                               value="{{$d->id}}">
                                                    </div>
                                                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" type="hidden" name="status"
                                                               value="cancel">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="reason" class="col-sm-2 col-form-label"></label>
                                                    <div class="col-md-8 ">
                                                        <textarea type="input" name="reason" value=""
                                                                  class="form-control" id="reason"
                                                                  placeholder="isi alasan"></textarea>
                                                    </div>
                                                    <div class="col-md-10"><br>
                                                    <button type="submit" class="btn btn-raised btn-primary pull-right">
                                                        Submit
                                                    </button>
                                                    </div>
                                                </div>
                                            </form>
                                          </div>
                                      </div>
                                 </div>

            @endforeach
    <script type="text/javascript">
        $(document).ready(function (dateText) {
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
        <script>

    $('#datetimepicker1').datetimepicker({
    format: 'YYYY-MM-DD',

        })

    </script>
    <script>
    $('#datetimepicker2').datetimepicker({
    format: 'YYYY-MM-DD',
    })
     </script>
 





@endrole
@endsection