@extends('layouts.admin')
@section('title','Account')
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
                    <li class="breadcrumb-item active">List Account</li>
                </ol>
            </div>
        </div>
    </div>
    @include('layouts.alert')
    <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">List Account </h6>
            <button type="button" class="btn btn-primary create" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Create new account
            </button>
        </div>
        <div class="card-body">
            @include('admin.account._list')
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
            <form action="{{ URL::to('/admin/account/create') }}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group @error('name') is-invalid @enderror">
                        <label class="role" for="name"><b>Name:</b></label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="">
                    </div>
                    @if ($errors->has('name'))
                    <span>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                    @endif
                    <div class="form-group @error('email') is-invalid @enderror">
                        <label class="role" for="email"><b>Email:</b></label>
                        <input type="text" name="email" class="form-control" id="email" placeholder="">
                    </div>
                    @if ($errors->has('email'))
                    <span>
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                    @endif
                    <div class="form-group @error('password') is-invalid @enderror">
                        <label class="role" for="password"><b>Password:</b></label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter password">
                    </div>
                    @if ($errors->has('password'))
                    <span>
                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                    @endif
                    <div class="form-group @error('confirm_password') is-invalid @enderror">
                        <label class="role" for="password_confirmation"><b>Confirm Password:</b></label>
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Please confirm password">
                    </div>
                    @if ($errors->has('password_confirmation'))
                    <span>
                        @error('password_confirmation')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                    @endif
                    <div class="form-group">
                    <label for="exampleInputEmail1"><b>Role ID:</b></label>
                    </br>
                    <select name="role_id" class="classic">
                        @foreach($roles as $key => $role) 
                        <option value="{{$role->id}}">{{$role->role_name}}</option>
                        @endforeach
                    </select>
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
            ajax: '{{ url('/admin/account/dt-row-data')}}',
            columns: [
                {
                    data: 'name',
                    name: 'name',
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'role_name',
                    name: 'role_name'
                },
                {
                    data: 'is_lock',
                    name: 'is_lock',
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
    @if($errors->has('name')||$errors->has('email')||$errors->has('password')||$errors->has('password_confirmation'))
    var delayInMilliseconds = 1000;
    setTimeout(function() {
        $("#exampleModal").modal('show');
    }, delayInMilliseconds);
    @endif
</script>
@endsection