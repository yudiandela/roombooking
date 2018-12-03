@extends('layouts.app')
@section('content')

    <script>
        tinymce.init({
            selector:'textarea',
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

                xhr.onload = function() {
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
            $('.attend').select2 ({
                placeholder: 'Select Attend',
                multiple: true,
                ajax:{
                    dataType: 'json',
                    url: '<?php echo url('ajax/reservation/get-attend'); ?>',
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

        //Datetime Start
        $(function () {
            var elemValue = localStorage.getItem("date");
            var dateNow = new Date();
            $('#datetimepicker5').datetimepicker({
                defaultDate: elemValue,
                format: 'DD-MM-YYYY HH:mm'
            })
        });

        //Datetime End
        $(function () {
            var elemValue = localStorage.getItem("date");
            var dateNow = new Date();
            $('#datetimepicker6').datetimepicker({
                defaultDate:  elemValue,
                format: 'DD-MM-YYYY HH:mm'
            })
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

    @if(session('error'))
        <script type="text/javascript">
            swal("Error!", "Kapasitas Ruangan Tidak Mencukupi", "error");
        </script>
    @endif
    <div class="grid-system">
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
                {!! BootForm::open(['url'=>route('reservation.store')]) !!}
            @endif
            <div class="row">
                <div class="col-md-12">
                    <h5> User </h5>
                    {!! Form::select('user_id', $select1, 'Select User', ['class' => 'select2 form-control']) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h5> Participant </h5>
                    {!! Form::select('user[]', [], null, ['class' => 'attend form-control']) !!}
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-12">
                    {!!BootForm::text('subject','Meeting Subject')!!}
                </div>

                <div class="col-sm-12">
                    {!!BootForm::textarea('description','Description')!!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h5> Area </h5>
                    {!! Form::select('area_id', $select2, null, ['class' => 'select2 form-control','onchange'=>'getRooms(this.value)']) !!}
                </div>
            </div>
            <div id="loading">
                <i class="fa fa-spinner fa-spin"></i>
                Loading...
            </div>

            <div id="rooms-container">
                <div class="row">
                    <div class="col-md-12">
                        <h5> Room </h5>
                        {!! Form::select('room_id', $select3, null, ['class' => 'select2 form-control','id'=>'select-rooms']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h5> Type </h5>
                    <label class="radio-inline"> {!! Form::radio('type', 'Internal') !!} Internal </label>
                    <label class="radio-inline"> {!! Form::radio('type', 'Eksternal') !!} Eksternal </label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h5> Unit </h5>
                    {!! Form::select('unit_id', $select4, null, ['class' => 'select2 form-control']) !!}
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-12">
                    {!!BootForm::text('contact_hp','Contact HP')!!}
                </div>

                <div class="col-md-12">
                    {!!BootForm::text('contact_name','Contact Name')!!}
                </div>

                <div class="col-md-12">
                    {!!BootForm::email('contact_email','Contact Email')!!}
                </div>

                <div class="col-md-12">
                    {!!BootForm::email('manager_email','Manager Email')!!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h5>Start</h5>
                    <div class="form-group">
                        <div class='input-group date' id='datetimepicker5'>
                        {!! Form::datetime('start',  null, ['class' => 'input-group date form-control']) !!}
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                        </div>
                    </div>

                    <h5>End</h5>
                    <div class="form-group">
                        <div class='input-group date' id='datetimepicker6'>
                            {!! Form::datetime('end',  null, ['class' => 'input-group date form-control']) !!}
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                             </span>
                        </div>
                    </div>
                </div>
            </div>

            {!!BootForm::submit('Save')!!}
            {!!BootForm::close()!!}
            <div class="clearfix"></div>
        </div>
    </div>
@endsection

