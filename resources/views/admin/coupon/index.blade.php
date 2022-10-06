@extends('layouts.admin')
@section('title','Coupon for customer')
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
    i.coupon_status{
        color:green;
        font-size:25px;
    }
    i.coupon{
        color:red;
        font-size:25px;
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
                    <li class="breadcrumb-item active">List coupon</li>
                </ol>
            </div>
        </div>
    </div>
    @include('layouts.alert')
    <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">List coupon </h6>
            <button type="button" class="btn btn-primary create" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Create new coupon
            </button>
        </div>
        <div class="card-body">
            @include('admin.coupon._list')
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create a new coupon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.coupon.saveCoupon') }}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group @error('coupon_name') is-invalid @enderror">
                        <label class="role" for="coupon_name"><b>Coupon name:</b></label>
                        <input type="text" name="coupon_name" class="form-control" placeholder="">
                    </div>
                    @if ($errors->has('coupon_name'))
                    <span>
                        @error('coupon_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                    @endif
                    <div class="form-group @error('coupon_date_start') is-invalid @enderror">
                        <label class="role" for="coupon_date_start"><b>Coupon date start</b></label>
                        <input type="date" name="coupon_date_start" class="form-control" placeholder="">
                    </div>
                    @if ($errors->has('coupon_date_start'))
                    <span>
                        @error('coupon_date_start')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                    @endif
                    <div class="form-group @error('coupon_date_end') is-invalid @enderror">
                        <label class="role" for="coupon_date_end"><b>Coupon date end:</b></label>
                        <input type="date" name="coupon_date_end" class="form-control" placeholder="">
                    </div>
                    @if ($errors->has('coupon_date_end'))
                    <span>
                        @error('coupon_date_end')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                    @endif
                    <div class="form-group @error('coupon_code') is-invalid @enderror">
                        <label class="role" for="coupon_code"><b>Coupon code</b></label>
                        <input type="text" name="coupon_code" class="form-control" placeholder="">
                    </div>
                    @if ($errors->has('coupon_code'))
                    <span>
                        @error('coupon_code')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                    @endif
                    <div class="form-group @error('coupon_time') is-invalid @enderror">
                        <label class="role" for="coupon_time"><b>Number of coupon</b></label>
                        <input type="text" name="coupon_time" class="form-control" placeholder="">
                    </div>
                    @if ($errors->has('coupon_time'))
                    <span>
                        @error('coupon_time')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                    @endif
                    <div class="form-group @error('coupon_condition') is-invalid @enderror">
                        <label class="role" for="coupon_condition"><b>Coupon Condition</b></label>
                        <select name="coupon_condition" class="form-control input-sm m-bot15">
                                <option value="0">---Selected---</option>
                                <option value="2">Cash coupon</option>
                                <option value="1">Percentage coupon</option>
                        </select>
                    </div>
                    @if ($errors->has('coupon_condition'))
                    <span>
                        @error('coupon_condition')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                    @endif
                    <div class="form-group @error('coupon_number') is-invalid @enderror">
                        <label class="role" for="coupon_number"><b>Enter the reduction amount or percentage reduction:</b></label>
                        <input type="text" name="coupon_number" class="form-control" placeholder="">
                    </div>
                    @if ($errors->has('coupon_number'))
                    <span>
                        @error('coupon_code')
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
            ajax: '{{ url('/admin/coupon/dt-row-data')}}',
            columns: [
                {
                    data: 'coupon_name',
                    name: 'coupon_name',
                },
                {
                    data: 'coupon_time',
                    name: 'coupon_time'
                },
                {
                    data: 'coupon_date_end',
                    name: 'coupon_date_end'
                },
                {
                    data: 'coupon_number',
                    name: 'coupon_number'
                },
                {
                    data: 'coupon_code',
                    name: 'coupon_code'
                },
                {
                    data: 'coupon_status',
                    name: 'coupon_status'   
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
    @if($errors->has('coupon_name')||$errors->has('coupon_time')||$errors->has('coupon_code')||$errors->has('coupon_condition')||$errors->has('coupon_number'))
    var delayInMilliseconds = 1000;
    setTimeout(function() {
        $("#exampleModal").modal('show');
    }, delayInMilliseconds);
    @endif
</script>
@endsection