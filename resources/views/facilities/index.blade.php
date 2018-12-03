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
            {{Html::link('/facilities/add','+Tambah data Baru',['class'=>'btn btn-primary'])}}
            <div class="grid-hor">
            <div class="content table-responsive table-full-width">
            <div class="col-md-6">
                <table class="table table-hover table-striped" id="table">
                <thead>
                <tr>
                    <th>Nama</th>
                    
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($facilities as $facility)
                    <tr>
                        <td>{{$facility->name}}</td>
                       
                      
                        <th>{{Html::link(route('facilities.edit', $facility->id), 'Edit',['class'=>'btn btn-warning btn-md pull-right']) }}</th>
                        <th>
                            <a href="{{route('facilities.delete',$facility->id)}}"data-target="#modalDelete{{ $facility->id }}"
                               data-toggle="modal" id="modal-edit" title="Edit">  <button class="btn btn-danger btn-md">Delete</button></a>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    @foreach($facilities as $facility)
        <div class="modal fade" id="modalDelete{{$facility->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h2 class="modal-title">Apakah yakin menghapus data  {{$facility->name}}</h2>
                    </div>
                    <div class="modal-footer">
                        {!! Form::open(['route'=>['facilities.delete',$facility->id]]) !!}
                        {!! method_field('DELETE') !!}
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        {!! Form::submit('Delete',array('class'=>'btn btn-danger btn-md')) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        
    @endforeach
    <script type="text/javascript">
        $(document).ready(function(){
            $('.table').DataTable({
                "pageLength": 4,
                "lengthMenu": [ [4,10, 15, 25, 50, -1], [4,10, 15, 25, 50, "All"] ],
                "order": [[ 0, "asc" ], [1, "asc"]],
                "columnDefs": [{ "orderable": false, "targets": [5,6] }],
            });
        });
    </script>
@endsection