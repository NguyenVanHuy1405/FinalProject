@extends('layouts.admin')
@section('title','List room by room type')
@section('custom-css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" /><!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<!-- Default theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
<title>Room of Hotel</title>
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
</style>    
@endsection

@section('content')
<div class="container">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">List room by room type</li>
                </ol>
            </div>
        </div>
    </div>
    @include('layouts.alert')
    <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">List room by room type : {{$room_type->roomtype_name}}</h6>
        </div>
        <div class="card-body">
            @include('admin.room._listBy')
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
            ajax: '{{ url('/admin/room/listRoom/'.$room_type->id.'/dt-row-data')}}',
            columns: [
                {
                    data: 'room_name',
                },
                {
                    data: 'room_price',
                },
                {
                    data: 'room_content',
                },
                {
                    data: 'room_image',
                },
            ]
        });
        $('#users-table_wrapper').removeClass('form-inline');
    });
</script>
@endsection