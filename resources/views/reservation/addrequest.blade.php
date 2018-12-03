@extends('layouts.app')
@section('content')
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],
            content_css: "css/content.css",
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
            style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
            ],

            images_upload_url: 'upload.php',
            images_upload_handler: function (blobInfo, success, failure) {
                var xhr, formData;
                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', 'upload.php');
                xhr.onload = function () {
                    var json;
                    if (xhr.status != 200) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }
                    json = JSON.parse(xhr.responseText);
                    if (!json || typeof json.location != 'string') {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }
                    success(json.location);
                };
                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                xhr.send(formData);
            },
        });
        $(document).ready(function () {
            $('.select2').select2();
            $('#rooms-container').hide();
            $('#loading').hide();

            //select2 multiple ajax search
            $('.attendence').select2 ({
                placeholder: 'Select Attendence',
                multiple: true,
                ajax:{
                    dataType: 'json',
                    url: '<?php echo url('ajax/reservation/getting-attendence'); ?>',
                    data: function (params) {
                        var query = {
                            user: params.term,
                        }
                        return query;
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        });
    </script>
    <div class="grid-system">
        @if(session('alertedit'))
            <script type="text/javascript">
                swal("Good job!", "You clicked the button!", "success");
            </script>
        @elseif(session('conflict'))
            <script type="text/javascript">
                swal("Error!", "Jadwal sudah terisi silahkan pilih jadwal yang lain", "error");
            </script>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="horz-grid">
            @if(empty($data))
                {!! BootForm::open(['url'=>route('reservation.storerequest') ]) !!}
            @endif
            <div class="row">

                    <div class="col-md-12">
                        <h5> Participant </h5>
                        {!! Form::select('user[]', [], null, ['class' => 'attendence form-control']) !!}
                    </div>
                <div class="col-md-5">
                    <h5>Meeting Subject</h5>
                    {!!Form::text('subject','',['class' => 'input-group date form-control'])!!}
                </div>
                <div class="col-sm-3">
                    <h5>Start</h5>
                    <div class='input-group date' id='datetimepicker5'>
                        {!! Form::datetime('start',null, ['class' => 'input-group date form-control']) !!}
                        <span class="input-group-addon">
                             {{--<span class="glyphicon glyphicon-calendar"></span>--}}
                            <span class="glyphicon glyphicon-calendar"></span>
                         </span>
                    </div>
                    <script type="text/javascript">
                        $(function () {
                            var elemValue = localStorage.getItem("date");
                            var dateNow = new Date();
                            $('#datetimepicker5').datetimepicker({
                                defaultDate: elemValue,
                                format: 'YYYY-MM-DD HH:mm:ss',
                            })
                        })
                    </script>
                </div>
                <div class="col-sm-3">
                    <h5>End</h5>
                    <div class="form-group">
                        <div class='input-group date' id='datetimepicker6'>
                            {!! Form::datetime('end',  null, ['class' => 'input-group date form-control']) !!}
                            <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $(function () {
                            //get value dari page lain
                            var elemValue = localStorage.getItem("date");
                            var dateNow = new Date();
                            $('#datetimepicker6').datetimepicker({
                                defaultDate: elemValue,
                                format: 'YYYY-MM-DD HH:mm:ss',
                            })
                        })
                    </script>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <h5> Area </h5>
                    {!! Form::select('area_id', $select1,request()->idArea ,['class' => 'js-example-basic-single form-control']) !!}
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('.js-example-basic-single').select2();
                        });
                    </script>
                </div>
                <div class="col-md-4">
                    <h5> Room </h5>
                    {!! Form::select('room_id', $select2, request()->idRoom, ['class' => 'js-example-basic-single form-control']) !!}

                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('.js-example-basic-single').select2();
                        });
                    </script>
                </div>
                <div class="col-md-4">
                    <h5> Type </h5>
                    <label class="radio-inline"> {!! Form::radio('type', 'Internal') !!} Internal </label>
                    <label class="radio-inline"> {!! Form::radio('type', 'Eksternal') !!} Eksternal </label>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <h5> Unit </h5>
                    {!! Form::select('unit_id', $select3, null, ['class' => 'js-example-basic-single form-control']) !!}
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('.js-example-basic-single').select2();
                        });
                    </script>
                </div>
                <div class="col-md-4">
                    <h5> Contact Name </h5>
                    {!!Form::text('contact_name', null, ['class' => 'input-group date form-control'])!!}
                </div>
                <div class="col-md-4">
                    <h5> Contact Hp </h5>
                    {!!Form::text('contact_hp', null, ['class' => 'input-group date form-control'])!!}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <h5> Contact Email </h5>
                    {!!Form::email('contact_email',null, ['class' => 'input-group date form-control'])!!}
                </div>
                <div class="col-md-6">
                    <h5> Manager Email </h5>
                    {!!Form::email('manager_email',null, ['class' => 'input-group date form-control'])!!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {!!BootForm::textarea('description','Description')!!}
                </div>
            </div>
            <br>
            {!!BootForm::submit('Request',[request()->idArea , request()->idRoom])!!}
            {!!BootForm::close()!!}
            <div class="clearfix"></div>
        </div>
    </div>
@endsection
