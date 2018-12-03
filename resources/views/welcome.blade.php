@extends('layouts.app')
@section('content')
    <!--content-->
    <div class="content-top">
        <div class="panel-body">
            @if (session('alertedit'))
                <script type="text/javascript">
                    swal("Good job!", "You clicked the button!", "success");
                </script>
            @endif
                <script type="text/javascript">
                    function getRooms(areaId) {
                        $.ajax({
                            dataType: "html",
                            url: "{{ route('ajax.rooms.byarea') }}",
                            data: {
                                areaId: areaId
                            },
                            success: function (html) {
                                $("#select-rooms").html(html);
                            }
                        });
                    }
                </script>
            @role('admin')
            <div class="col-md-5 ">
                <div class="content-top-1">
                    <div class="col-md-4 top-content">
                        <label>{{$ruangan}} ruangan</label>
                    </div>
                    <div class="col-md-6 top-content1">
                        <div id="demo-pie-1" class="pie-title-center" data-percent="25"><span class="pie-value"></span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="content-top-1">
                    <div class="col-md-4 top-content">
                        <label>{{$areaC}} area</label>
                    </div>
                    <div class="col-md-6 top-content1">
                        <div id="demo-pie-2" class="pie-title-center" data-percent="50"><span class="pie-value"></span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="content-top-1">
                    <div class="col-md-4 top-content">

                        <label>{{$unit}} unit</label>
                    </div>
                    <div class="col-md-6 top-content1">
                        <div id="demo-pie-3" class="pie-title-center" data-percent="75"><span class="pie-value"></span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="content-top-1">
                    <h2>Ruangan yang tersedia</h2><br>
                    <div class="content table-responsive table-full-width">

                        <table class="table table-hover table-striped " id="table">
                            <thead>

                            <tr>
                                <td>Area</td>
                                <td>Unit</td>
                                <td>Ruangan</td>
                                <td>Foto</td>
                                <td>Status</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($available as $rooms)
                                <tr>
                                    <td>{{$rooms->area->name}}</td>
                                    <td>{{$rooms->area->unit->name}}</td>
                                    <td>{{$rooms->name}}</td>
                                    <td> @if(empty($rooms->photo))
                                            <img src="https://via.placeholder.com/100" style="border-radius:50% "/>
                                        @else
                                            <img src="{{asset('img/'.$rooms->photo)}}" class="img-responsive" style="height: 100px; width: 100px;border-radius:50%" alt="">
                                        @endif
                                    </td>
                                    <td>
                                        <label class="label label-info">Tersedia</label>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$available->links()}}
                    </div>
                </div>
            </div>
            @endrole
            @ability('guest,employee', '')
            <div class="grid-system">
                <div class="horz-grid">
                    <div class="grid-hor">
                        <div class="col-md-6">
                            <div class="">
                                <?php
                                $month = date("m");
                                $year = date("Y");
                                ?>
                                {!!BootForm::select('month',' ', ['01'=>'January','02'=>'February','03'=>'March','04'=>'April',
                                '05'=>'May','06'=>'June','December'=>'July','08'=>'August','09'=>'September','10'=>'October',
                                '11'=>'November','12'=>'Desember',],['selected'=>$month],['id'=>'month'])!!}
                            </div>
                            <div class="">
                                {!!BootForm::select('year',' ', [
                                '2018'=>'2018','2019'=>'2019','2020'=>'2020','2021'=>'2021','2022'=>'2022','2023'=>'2023',
                                '2024'=>'2024','2025'=>'2025','2026'=>'2026','2027'=>'2027','2028'=>'2028','2029'=>'2029',]
                                ,['selected'=>$year],['id'=>'year'])!!}
                            </div>
                        </div>
                        {!! BootForm::open([
                   'method'=>'get',
                ]) !!}
                        <div class="col-md-6">
                            <div class=""></div>
                            {!!BootForm::select('area',' ', $area, null,['onchange'=>'getRooms(this.value)'])!!}
                            <div id="rooms-container">
                                <div class="">
                                    {!!BootForm::select('room',' ', $room, request()->idRoom, ['id'=>'select-rooms',
                                     'onchange'=>'room.form.submit()',]) !!}
                                </div>
                                {!!BootForm::close()!!}
                            </div>
                        </div>
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
        @endability
        <div class="clearfix"></div>
    </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.table').DataTable({
                "pageLength": 2,
                "lengthMenu": [[2,4, 10, 15, 25, 50, -1], [2,4, 10, 15, 25, 50, "All"]],
                "order": [[0, "asc"], [1, "asc"]],
                "columnDefs": [{"orderable": false}],
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            var t = new Date();
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today myCustomButton',
                    center: 'title',
                    right: 'month,basicWeek,basicDay,listWeek'
                },
                views: {
                    listDay: {buttonText: 'list day'},
                    listWeek: {buttonText: 'list week'}
                },

                // eventClick:  function(event, jsEvent, view) {
                //     $('#modalTitle').html(event.title);
                //     $('#modalBody').html(event.description);
                //     $('#calendarModal').modal();
                // },

                defaultDate: t,
                navLinks: true,
                eventLimit: true,
                editable: true,
                async: false,
                selectHelper: true,
                eventRender: function (event, element) {
                    element.popover({
                        animation: true,
                        delay: 300,
                        content: event.status,
                        trigger: 'hover'
                    });
                },
                events: [
                        @foreach($calendar as $event)
                    {
                        title: '{{ $event->subject }}',
                        {{--description: '{!! $event->description !!}',--}}
                        start: '{{ $event->start }}',
                        status: '{{$event->status}}',
                        end: '{{ $event->end }}',
                        url: '{{ route('reservation.detail', $event->id) }}',
                        @if($event->status == 'pending')
                        backgroundColor: 'grey',
                        @elseif($event->status == 'reject')
                        backgroundColor: 'red',
                        @endif
                    },
                    @endforeach

                ],
            });
            $("#month").change(function () {
                var date = new Date();
                var year = date.getFullYear();
                var month = $(this).val();
                var day = date.getDay();
                var now = year + '-' + month + '-' + day;
                $('#calendar').fullCalendar('gotoDate', year + '-' + month + '-01');
            });
            $("#year").change(function () {
                var date = new Date();
                var year = $(this).val();
                var month = date.getMonth();
                var day = date.getDay();
                var now = year + '-' + month + '-' + day;
                $('#calendar').fullCalendar('gotoDate', year + '-' + month + '-01');
            });
        });
    </script>
@endsection