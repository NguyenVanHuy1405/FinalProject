@extends('layouts.admin')
@section('title','Edit kind of room Hotel')
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
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit kind of room</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="signup-content">
            <form action="{{URL::to('/admin/kindofroom/update/'.$kindofroom->id)}}" method="POST" id="signup-form" class="signup-form">
                {{ csrf_field() }}
                <h2 class="form-title">Edit kind of room</h2>
                <div class="col-lg-15">
                    <div class="form-group @error('kindofroom_name') is-invalid @enderror">
                        <label for="kindofroom_name"><b>Kind of room Name:</b></label>
                        <input type="text" class="form-control item" name="kindofroom_name" id="kindofroom_name" value="{{$kindofroom->kindofroom_name}}">
                    </div>
                    @if ($errors->has('kindofroom_name'))
                    <span>
                        @error('kindofroom_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                    @endif
                </div>
                <div class="col-lg-15">
                    <div class="form-group @error('kindofroom_desc') is-invalid @enderror">
                        <label for="kindofroom_desc"><b>Kind of room Description:</b></label>
                        <input type="text" class="form-control item" name="kindofroom_desc" id="kindofroom_desc" value="{{$kindofroom->kindofroom_desc}}">
                    </div>
                    @if ($errors->has('kindofroom_desc'))
                    <span>
                        @error('kindofroom_desc')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <input type="submit" class="form-submit" value="Update kind of room" />
                </div>
            </form>
        </div>
</section>

</div>
@endsection