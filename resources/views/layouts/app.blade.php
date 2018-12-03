<!--
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
    <title>Booking Ruangan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="Minimal Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design"/>
    <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        } </script>

    {{--<link href="{{asset('css/admin_css/bootstrap.min.css')}}" rel='stylesheet' type='text/css'/>--}}
    <!-- Custom Theme files -->
    <link href="{{asset('css/admin_css/style.css')}}" rel='stylesheet' type='text/css'/>
    <link href="{{asset('css/admin_css/font-awesome.css')}}" rel="stylesheet">
    <script src="{{asset('js/admin_js/jquery.min.js')}}"></script>
    <!-- Mainly scripts -->
    <script src="{{asset('js/admin_js/jquery.metisMenu.js')}}"></script>
    <script src="{{asset('js/admin_js/jquery.slimscroll.min.js')}}"></script>
    <!-- Custom and plugin javascript -->
    <link href="{{asset('css/admin_css/custom.css')}}" rel="stylesheet">
    <script src="{{asset('js/admin_js/custom.js')}}"></script>
    <script src="{{asset('js/admin_js/custom1.js')}}"></script>
    <script src="{{asset('js/admin_js/screenfull.js')}}"></script>
    <link href="{{asset('css/admin_css/owl.carousel.css')}}" rel="stylesheet">
    <script src="{{asset('lib/year-select.js')}}"></script>
    <script src="{{asset('js/admin_js/owl.carousel.js')}}"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
          integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- js untuk datepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet"
          type="text/css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker-en-CA.min.js"></script>

    <!-- js untuk datetimepicker -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css"
          rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
          rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.css"
          rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css"
          rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css.map"
          rel="stylesheet">
    <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
    {{--<link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css"--}}
          {{--rel="stylesheet">--}}
    <link href="{{ asset('css/timepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('css/standalone.css') }}" rel="stylesheet">

    <!-- js untuk fullcalendar -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css'/>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js'></script>

    {{--Untuk TINYMCE EDITOR--}}
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>

    <!-- js untuk select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    {{--<!-- AJAX untuk select2 -->--}}
    {{--<link href="{{ asset('public/css/select2.min.css')}}" rel="stylesheet" />--}}
    {{--<script src="{{ asset('public/js/select2.min.js')}}"></script>--}}

    {{--data table--}}
    <link href="{{asset('css/admin_css/dataTables.bootstrap4.min.css')}}" rel='stylesheet' type='text/css'/>

    {{--<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>--}}
    {{--<script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>--}}

    {{--sweetalert cdn--}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.26.29/sweetalert2.css">
    <link rel="stylesheet"
          href=" https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.26.29/sweetalert2.min.css">
    <script>
        $(function () {
            $('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

            if (!screenfull.enabled) {
                return false;
            }
            $('#toggle').click(function () {
                screenfull.toggle($('#container')[0]);
            });
        });
    </script>

    <!----->

    <!--pie-chart--->
    <script src="{{asset('js/admin_js/pie-chart.js')}}" type="text/javascript"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            $('#demo-pie-1').pieChart({
                barColor: '#3bb2d0',
                trackColor: '#eee',
                lineCap: 'round',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });

            $('#demo-pie-2').pieChart({
                barColor: '#fbb03b',
                trackColor: '#eee',
                lineCap: 'butt',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });

            $('#demo-pie-3').pieChart({
                barColor: '#ed6498',
                trackColor: '#eee',
                lineCap: 'square',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });


        });

    </script>
    <!--skycons-icons-->
    <script src="{{asset('js/admin_js/skycons.js')}}"></script>
    <!--//skycons-icons-->
</head>
<body>
<div id="wrapper">
    <!----->
    <nav class="navbar-default navbar-static-top" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <h1><a class="navbar-brand" style="margin-top: -20px" href="{{url('/')}}">MRBS
                    <H5>MEETING ROOM BOOKING SYSTEM</H5>
                </a></h1>

        </div>
        <div class=" border-bottom">
            <div class="full-left">
                <section class="full-top">
                    <button id="toggle"><i class="fa fa-arrows-alt"></i></button>
                </section>
                <form class=" navbar-left-right">
                    <input type="text" value="Search..." onfocus="this.value = '';"
                           onblur="if (this.value == '') {this.value = 'Search...';}">
                    <input type="submit" value="" class="fa fa-search">
                </form>
                <div class="clearfix"></div>
            </div>
            <!-- Brand and toggle get grouped for better mobile display -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="drop-men">
                <ul class=" nav_1">
                    @role('admin')
                    <li class="dropdown at-drop">
                        <a href="#" class="dropdown-toggle dropdown-at " data-toggle="dropdown"><i
                                    class="fa fa-globe"></i>

                            <span class="number">{{count($notif)}}</span>
                        </a>
                        <ul class="dropdown-menu menu1 ">
                             @foreach($notif as $notifs)
                                <?php
                                $datetime1 = new DateTime();
                                $datetime2 = new DateTime($notifs->created_at);
                                $interval = $datetime1->diff($datetime2);
                                ?>
                                <li>
                                    <a href="reservation?tgl_awal=&tgl_akhir=&status=pending&area=&room={{$notifs->room_id}}">
                                        <div class="user-new">
                                            <p>{{$notifs->subject}}</p>
                                            @if($interval->format('%a') != 0)
                                                <span>{{
                                            $interval->format('%a days ago')
                                            }}</span>
                                            @elseif($interval->format('%h') != 0)
                                                <span>{{
                                            $interval->format('%h hours ago')
                                            }}</span>
                                                </span>
                                            @elseif($interval->format('%i') != 0)
                                                <span>{{
                                            $interval->format('%i minutes ago')
                                            }}
                                                </span>
                                            @else
                                                <span>{{
                                            $interval->format('%S seconds ago')
                                            }}
                                                </span>
                                            @endif
                                        </div>

                                        <div class="clearfix"></div>
                                    </a>
                                </li>
                            @endforeach

                                <li><a href="reservation?tgl_awal=&tgl_akhir=&status=pending&area=&room=" class="view">View
                                        all Pending</a></li>



                        </ul>
                    </li>
                    @endrole
                    <li class="dropdown">
                        {{--<style>--}}
                        {{--img {--}}
                        {{--vertical-align: middle;--}}
                        {{--width: 70px;--}}
                        {{--height: 70px;--}}
                        {{--border-radius: 50%;--}}
                        {{--}--}}
                        {{--</style>--}}
                        <a href="#" class="dropdown-toggle dropdown-at" data-toggle="dropdown"><span
                                    class=" name-caret">{{Auth::user()->name}}<i class="caret"></i></span>
                            {{--{{Html::image('img/'.Auth::user()->photo)}}--}}
                            @if(Auth::user()->photo==null)

                            <img src="https://via.placeholder.com/100" style="border-radius:50%"/>
                            @else
                            <img src="{{asset('img/'.Auth::user()->photo)}}" style="height: 70px; width: 70px; border-radius:50%;
vertical-align: middle;" alt="">
                            @endif
                        </a>

                        <ul class="dropdown-menu " role="menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"
                                   class=" hvr-bounce-to-right">
                                    <i class="fa fa-sign-out-alt"></i>Logout
                                </a>
                            </li>
                            <form id="frm-logout" action="{{route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </ul>
                    </li>

                </ul>
            </div><!-- /.navbar-collapse -->
            <div class="clearfix">

            </div>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">

                        <li>
                            <a href="{{ url('/') }}" class=" hvr-bounce-to-right"><i
                                        class="fa fa-desktop nav_icon "></i><span class="nav-label">
                                    Dashboards
                                </span> </a>
                        </li>
                        <li>
                            @ability('employee,admin', '')
                            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-edit nav_icon"></i> <span
                                        class="nav-label">Reservation</span><span class="fa arrow"></span></a>
                            @endability
                            <ul class="nav nav-second-level">
                                @role('admin')
                                <li><a href="{{ route('reservation.index') }}" class=" hvr-bounce-to-right"> <i
                                                class="fa fa-area-chart nav_icon"></i>List Reservation</a></li>
                                @endrole

                                @role('employee')
                                <li><a href="{{ route('reservation.reservationArea') }}" class=" hvr-bounce-to-right">
                                        <i class="fa fa-area-chart nav_icon"></i>Booking Room</a></li>
                                <li><a href="{{ route('reservation.show') }}" class=" hvr-bounce-to-right"> <i
                                                class="fa fa-suitcase nav_icon"></i>MyBooking</a></li>


                                @endrole
                            </ul>
                        </li>
                        @role('admin')
                        <li>
                            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-edit nav_icon"></i> <span
                                        class="nav-label">Rooms</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="{{ url('rooms') }}" class=" hvr-bounce-to-right"> <i
                                                class="fa fa-area-chart nav_icon"></i>List of Rooms</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ url('areas') }}" class=" hvr-bounce-to-right"><i
                                        class="fa fa-trademark nav_icon"></i> <span class="nav-label">Areas</span><span
                                        class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="{{ url('areas') }}" class=" hvr-bounce-to-right"> <i
                                                class="fa fa-info-circle nav_icon"></i>List of Areas</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-street-view nav_icon"></i> <span
                                        class="nav-label">Unit</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="{{ url('units') }}" class=" hvr-bounce-to-right"><i
                                                class="fa fa-align-left nav_icon"></i>List of Unit</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-user-secret nav_icon"></i> <span
                                        class="nav-label">User</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="{{ url('users') }}" class=" hvr-bounce-to-right"><i
                                                class="fa fa-align-left nav_icon"></i>List of User</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-database nav_icon"></i> <span
                                        class="nav-label">Role & Permission</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="{{ url('roles') }}" class=" hvr-bounce-to-right"><i
                                                class="fa fa-align-left nav_icon"></i>List of Role</a></li>
                                <li><a href="{{ url('permissions') }}" class=" hvr-bounce-to-right"><i
                                                class="fa fa-align-left nav_icon"></i>List of Permission</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-database nav_icon"></i> <span
                                        class="nav-label">Facility</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="{{ url('facilities') }}" class=" hvr-bounce-to-right"><i
                                                class="fa fa-align-left nav_icon"></i>List of facility</a></li>
                            </ul>               

                        </li>
                        @endrole
                        <li>
                            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-cog nav_icon"></i> <span
                                        class="nav-label">Settings</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="{{url('password')}}" class=" hvr-bounce-to-right"><i
                                                class="fa fa-lock nav_icon"></i>Change Password</a></li>
                                <li><a href="{{route('users.editProfile' , Auth::user()->id)}}"
                                       class=" hvr-bounce-to-right"><i class="fa fa-user nav_icon"></i>Profile</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="content-main">
            <!--banner-->
            <div class="banner">
                <h2>
                    <a href="{{url('')}}">Home</a>
                    <i class="fa fa-angle-right"></i>
                    <span>
                        @if(Request::is('/'))
                            Dashboard
                        @elseif(Request::is('rooms'))
                            Ruangan
                        @elseif(Request::is('areas'))
                            Area
                        @elseif(Request::is('units'))
                            Unit
                        @elseif(Request::is('users'))
                            User
                        @elseif(Request::is('reservation'))
                            Reservation
                        @elseif(Request::is('areas/add'))
                            <a href="{{url('areas')}}">Area</a>
                            <span>
                            <i class="fa fa-angle-right"></i> Tambah
                        </span>
                        @elseif(Request::is('units/add'))
                            <a href="{{url('units')}}">Unit</a>
                            <span>
                            <i class="fa fa-angle-right"></i> Tambah
                        </span>
                        @elseif(Request::is('users/add'))
                            <a href="{{url('users')}}">User</a>
                            <span>
                            <i class="fa fa-angle-right"></i> Tambah
                        </span>
                        @elseif(Request::is('rooms/add'))
                            <a href="{{url('rooms')}}">Ruangan</a>
                            <span>
                            <i class="fa fa-angle-right"></i> Tambah
                            </span>
                        @elseif(Request::is('reservation/addSchedule'))
                            <a href="{{url('reservation')}}">Reservation</a>
                            <span>
                            <i class="fa fa-angle-right"></i> Add Schedule
                            </span>
                        @elseif(Request::is('reservation/area'))
                            <span>
                           Add Reservation
                            </span>
                        @elseif(Request::is('reservation/area/*'))
                            <span>
                           Add Room
                            </span>
                        @elseif(Request::is('reservation/mybooking'))
                            <span>
                            MyBooking
                            </span>
                        @else
                        </span>
                    @endif
                    </span>
                </h2>
            </div>
            <!--//banner-->
            <!--content-->
        @yield('content')
        <!--//content-->
            <!---->
            <div class="copy">
                <p> &copy; 2018 Barkah. All Rights Reserved | Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a>
                </p>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!---->
<!--scrolling js-->
<script src="{{asset('js/admin_js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('js/admin_js/scripts.js')}}"></script>
<!--//scrolling js-->
<script src="{{asset('js/admin_js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/admin_js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('js/admin_js/jquery.dataTables.min.js')}}"></script>
<script>
    $(load_notif);

    function load_notif() {
        $.ajax({
            url: "",
            cache: false,
            success: function (data) {
                $("#load_notif_div").html(data);
                setTimeout(load_notif, 3000);
            }
        });
    }
</script>
</body>
</html>

