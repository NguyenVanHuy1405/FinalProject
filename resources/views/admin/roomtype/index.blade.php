@extends('layouts.admin')
@section('title','RoomType of Hotel')
@section('custom-css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" /><!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<!-- Default theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
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
    justify-content:center;
    }
    a.fa-thumb-styling.fa.fa-thumbs-up{
    font-size:20px;
    color:green;
    justify-content:center;
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
                    <li class="breadcrumb-item active">List room type</li>
                </ol>
            </div>
        </div>
    </div>
    @include('layouts.alert')
    <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">List Room Type</h6>
            <button type="button" class="btn btn-primary create" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Create new roomtype
            </button>
        </div>
        <div class="card-body">
            @include('admin.roomtype._list')
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create a new roomtype</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.roomtype.createRoomType') }}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group @error('roomtype_name') is-invalid @enderror">
                        <label class="role" for="roomtype_name"><b>Room type name:</b></label>
                        <input type="text" name="roomtype_name" class="form-control" id="roomtype_name" placeholder="">
                    </div>
                    @if ($errors->has('roomtype_name'))
                    <span>
                        @error('roomtype_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                    @endif
                    <div class="form-group @error('roomtype_desc') is-invalid @enderror">
                        <label class="role" for="roomtype_desc"><b>Room type description:</b></label>
                        <input type="text" name="roomtype_desc" class="form-control" id="roomtype_desc" placeholder="">
                    </div>
                    @if ($errors->has('roomtype_desc'))
                    <span>
                        @error('roomtype_desc')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                    @endif
                    <div class="form-group @error('roomtype_status') is-invalid @enderror">
                        <label class="role" for="roomtype_status"><b>Room type status:</b></label>
                        <select name="roomtype_status" class="form-control input-sm m-bot15">
                                <option value="0">Hide room type</option>
                                <option value="1">Display room type</option>
                        </select>
                    </div>
                    @if ($errors->has('roomtype_status'))
                    <span>
                        @error('roomtype_status')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                    @endif
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="createroomtype" id="createroomtype" class="btn btn-primary">Add Room Type</button>
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
            ajax: '{{ url('/admin/roomtype/dt-row-data')}}',
            columns: [{
                    data: 'id',
                    name: 'id',
                },
                {
                    data: 'roomtype_name',
                    name: 'roomtype_name',
                },
                {
                    data: 'roomtype_desc',
                    name: 'roomtype_desc',
                },
                {
                    data: 'roomtype_status',
                    name: 'roomtype_status'
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
    @if($errors->has('roomtype_name')||$errors->has('roomtype_desc')||$errors->has('roomtype_status'))
    var delayInMilliseconds = 1000;
    setTimeout(function() {
        $("#exampleModal").modal('show');
    }, delayInMilliseconds);
    @endif
</script>
@endsection