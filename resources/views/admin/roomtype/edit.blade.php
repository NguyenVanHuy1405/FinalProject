@extends('layouts.admin')
@section('title','Edit room type Hotel')
@section('custom-css')
<link rel="stylesheet" href="{{asset('admin/roomtype/fonts/material-icon/css/material-design-iconic-font.min.css')}}">

<link rel="stylesheet" href="{{asset('admin/roomtype/css/style.css')}}">
<style>
    div.signup-content{
        margin-left: 300px;
        margin-right: 300px;
    }
</style>
@endsection
@section('content')
<div class="main">
    <section class="signup">
        <!-- <img src="images/signup-bg.jpg" alt=""> -->
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
        <div class="signup-content">
            <form action="{{URL::to('/admin/roomtype/update/'.$roomtype->id)}}" method="POST" id="signup-form" class="signup-form">
                {{ csrf_field() }}
                <h2 class="form-title">Edit room type</h2>
                <div class="col-lg-15">
                    <div class="form-group @error('roomtype_name') is-invalid @enderror">
                        <label for="roomtype_name"><b>Room Type Name:</b></label>
                        <input type="text" class="form-control item" name="roomtype_name" id="roomtype_name" value="{{$roomtype->roomtype_name}}">
                    </div>
                    @if ($errors->has('roomtype_name'))
                    <span>
                        @error('roomtype_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                    @endif
                </div>
                <div class="col-lg-15">
                    <div class="form-group @error('roomtype_desc') is-invalid @enderror">
                        <label for="roomtype_desc"><b>Room Type Description:</b></label>
                        <input type="text" class="form-control item" name="roomtype_desc" id="roomtype_desc" value="{{$roomtype->roomtype_desc}}">
                    </div>
                    @if ($errors->has('roomtype_desc'))
                    <span>
                        @error('roomtype_desc')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <input type="submit" class="form-submit" value="Update room type" />
                </div>
            </form>
        </div>
</section>

</div>
@endsection