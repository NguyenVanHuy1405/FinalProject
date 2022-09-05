@extends('layouts.admin')
@section('title','Edit account')
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
                        <li class="breadcrumb-item active">Edit account/</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="signup-content">
            <form action="{{URL::to('/admin/account/update/'.$user->id)}}" method="POST" id="signup-form" class="signup-form">
                {{ csrf_field() }}
                <h2 class="form-title">Edit Account</h2>
                <div class="col-lg-15">
                    <div class="form-group @error('name') is-invalid @enderror">
                        <label class="role" for="name"><b>Name:</b></label>
                        <input type="text" name="name" class="form-control" id="name" value="{{$user->name}}">
                    </div>
                    @if ($errors->has('name'))
                    <span>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                    @endif
                    <div class="form-group">
                    <label for="exampleInputEmail1"><b>Role ID:</b></label>
                    </br>
                    <select name="role_id" class="classic">
                        @foreach($role_id as $key => $role) 
                        <option value="{{$role->id}}">{{$role->role_name}}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" class="form-submit" value="Update account" />
                </div>
            </form>
        </div>
</section>

</div>
@endsection