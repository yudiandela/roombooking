@extends('layouts.app')
@section('content')
    <div class="panel-body">
        @if (session('alertedit'))
            <script type="text/javascript">
                swal("Good job!", "Success", "success");
            </script>
        @elseif(session('conflict'))
            <script type="text/javascript">
                swal("Error!", "Jadwal sudah terisi silahkan pilih jadwal yang lain", "error");
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
                        {!!BootForm::select('area',' ', $area, request()->idArea,['onchange'=>'getRooms(this.value)'])!!}
                        <div id="rooms-container">
                            <div class="">
                                {!!BootForm::select('room',' ', $room, request()->idRoom, ['id'=>'select-rooms',
                                 'onchange'=>'room.form.submit()',]) !!}
                            </div>
                            {!!BootForm::close()!!}
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="calendarModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span
                                class="sr-only">close</span></button>
                    <h4 id="modalTitle" class="modal-title"></h4>
                </div>
                <div id="modalBody" class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @role('guest')
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

                dayClick: function (date, jsEvent, view) {
                    var fetchDate = $(this).data("date");
                    if (moment().format('YYYY-MM-DD') === date.format('YYYY-MM-DD') || date.isAfter(moment())) {
                        localStorage.setItem("date", fetchDate);
                        $(location).attr('href', '{{ route('reservation.addrequest',[request()->idArea , request()->idRoom]) }}');
                    } else {
                        sweetAlert("Oops...", "Tanggal harus lebih besar atau sama dengan tanggal sekarang!", "error");
                    }

                },
                defaultDate: t,
                navLinks: true,
                eventLimit: true,
                editable: true,
                async: false,
                selectable: true,
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
                        @foreach($reservation as $event)
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
    @endrole
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

                dayClick: function (date, jsEvent, view) {
                    var fetchDate = $(this).data("date");
                    if (moment().format('YYYY-MM-DD') === date.format('YYYY-MM-DD') || date.isAfter(moment())) {
                        localStorage.setItem("date", fetchDate);
                        $(location).attr('href', '{{ route('reservation.addrequest',[request()->idArea , request()->idRoom]) }}');
                    } else {
                        sweetAlert("Oops...", "Tanggal harus lebih besar atau sama dengan tanggal sekarang!", "error");
                    }

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
                selectable: true,
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
                        @foreach($reservation as $event)
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