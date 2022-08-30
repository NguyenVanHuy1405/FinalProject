@extends('layouts.admin')
@section('title','Kind of room Hotel')
@section('custom-css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" /><!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<!-- Default theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
<title>Kind room of Hotel</title>
<style>
    div.modal-header{
        background-color: LightGray;
    }
    option.button{
        font-size:11px;
    }
    div.label.role{
        font-size:20px;
    }
    a.fa-thumb-styling.fa.fa-thumbs-down{
    font-size:20px;
    color:red;
    }
    a.fa-thumb-styling.fa.fa-thumbs-up{
    font-size:20px;
    color:green;
    }
    button.create{
        height: 50px;
        width: 250px;
    }
</style>    
@endsection

@section('content')
<div class="container">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">List kind of room </li>
                </ol>
            </div>
        </div>
    </div>
    @include('layouts.alert')
    <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">List kind of room </h6>
            <button type="button" class="btn btn-primary create" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Create new kind of room
            </button>
        </div>
        <div class="card-body">
            @include('admin.kindofroom._list')
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create a new kind of room</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ URL::to('/admin/kindofroom/createKindofRoom') }}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group @error('kindofroom_name') is-invalid @enderror">
                        <label class="role" for="kindofroom_name"><b>Kind of room name:</b></label>
                        <input type="text" name="kindofroom_name" class="form-control" id="kindofroom_name" placeholder="">
                    </div>
                    @if ($errors->has('kindofroom_name'))
                    <span>
                        @error('kindofroom_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                    @endif
                    <div class="form-group @error('kindofroom_desc') is-invalid @enderror">
                        <label class="role" for="kindofroom_desc"><b>Kind of room description:</b></label>
                        <input type="text" name="kindofroom_desc" class="form-control" id="kindofroom_desc" placeholder="">
                    </div>
                    @if ($errors->has('kindofroom_desc'))
                    <span>
                        @error('kindofroom_desc')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                    @endif
                    <div class="form-group @error('kindofroom_status') is-invalid @enderror">
                        <label class="role" for="kindofroom_status"><b>Kind of room status:</b></label>
                        <select name="kindofroom_status" class="form-control input-sm m-bot15">
                                <option value="0">Hide kind of room</option>
                                <option value="1">Display kind of room</option>
                        </select>
                    </div>
                    @if ($errors->has('kindofroom_status'))
                    <span>
                        @error('kindofroom_status')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="createkindofroom" id="createkindofroom" class="btn btn-primary">Add kind of room</button>
                </div>
        </div>
    </div>
</div>
@endsection
@section('custom-js')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.colVis.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script>
    $(document).ready(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url('/admin/kindofroom/dt-row-data')}}',
            columns: [{
                    data: 'id',
                    name: 'id',
                },
                {
                    data: 'kindofroom_name',
                    name: 'kindofroom_name',
                },
                {
                    data: 'kindofroom_desc',
                    name: 'kindofroom_desc'
                },
                {
                    data: 'kindofroom_status',
                    name: 'kindofroom_status'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });
        $('#users-table_wrapper').removeClass('form-inline');
    });
</script>
<script>
    @if($errors->has('kindofroom_name')||$errors->has('kindofroom_desc')||$errors->has('kindofroom_status'))
    var delayInMilliseconds = 1000;
    setTimeout(function() {
        $("#exampleModal").modal('show');
    }, delayInMilliseconds);
    @endif
</script>
@endsection