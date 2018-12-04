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
    </script>

        <div class="grid-system">
        <div class="horz-grid">
            @if(empty($data))
                {!! BootForm::open([
                    'url'=>route('rooms.store'),
                    'files'=>'true'
                    ]) !!}
                {!! BootForm::label('facilities') !!}
                {!! BootForm::checkboxes('facility[]',null,$facilities,'',['multiple'=>true]) !!}
            @else
            {{-- {{ dd($data) }} --}}
                {!! BootForm::open([
                     'url'=>route('rooms.update',$data->id),
                     'model'=>$data,
                     'method'=>'put',
                     'files'=>'true'
                     ]) !!}
                {!! BootForm::label('facility') !!}
                {!! BootForm::checkboxes('facility[]', null, $allfacilities, $assignedfacilities, ['multiple'=>true]) !!}
            @endif
            <div class="row">
                <div class="col-md-12">
                    {!!BootForm::text('name','Name Room')!!}
                </div>
                <div class="col-md-12">
                    {!!BootForm::select('area_id','Area', $select) !!}
                </div>
                <div class="col-md-12">
                    {!!BootForm::number('capacity','Capacity')!!}
                </div>
                <div class="col-md-12">
                    {!!BootForm::text('contact_name','Contact Name')!!}
                </div>
                <div class="col-md-12">
                    {!!BootForm::email('contact_email','Contact Email')!!}
                </div>
                <div class="col-md-12">
                    {!!BootForm::text('contact_hp','Contact HP')!!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {!!BootForm::textarea('description','Description')!!}
                </div>
            </div>

             <div class="row">
                <div class="col-md-4">
                    {!! BootForm::checkbox('is_active') !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                <h4>Upload Photo</h4><br>
                <input type='file' id="photo" name="photo" onchange="loadFile(event)"/>

                <img id="output" src="{{ empty($data) ? '#' : url('img/' . $data->photo ) }}"style="height: 70px; width: 70px; border-radius:50%;" alt="foto ruangan"  />

                </div>
            </div>
            {!!BootForm::submit('save',['class'=>'btn btn-info btn-fill pull-right'])!!}
            {!!BootForm::close()!!}
            <div class="clearfix"></div>
            </div>
         </div>
    <script>
           var loadFile = function(event) {
           var reader = new FileReader();
           reader.onload = function(){
           var output = document.getElementById('output');
           output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };
    </script>
@endsection
