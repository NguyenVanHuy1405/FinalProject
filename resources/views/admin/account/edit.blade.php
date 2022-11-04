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
    select {

/* styling */
background-color: white;
border: thin solid blue;
border-radius: 4px;
display: inline-block;
font: inherit;
line-height: 1.5em;
padding: 0.5em 3.5em 0.5em 1em;

/* reset */

margin: 0;
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
box-sizing: border-box;
-webkit-appearance: none;
-moz-appearance: none;
}

select.classic {
background-image:
    linear-gradient(45deg, transparent 50%, blue 50%),
    linear-gradient(135deg, blue 50%, transparent 50%),
    linear-gradient(to right, skyblue, skyblue);
background-position:
    calc(100% - 20px) calc(1em + 2px),
    calc(100% - 15px) calc(1em + 2px),
    100% 0;
background-size:
    5px 5px,
    5px 5px,
    2.5em 2.5em;
background-repeat: no-repeat;
}

select.classic:focus {
background-image:
    linear-gradient(45deg, white 50%, transparent 50%),
    linear-gradient(135deg, transparent 50%, white 50%),
    linear-gradient(to right, gray, gray);
background-position:
    calc(100% - 15px) 1em,
    calc(100% - 20px) 1em,
    100% 0;
background-size:
    5px 5px,
    5px 5px,
    2.5em 2.5em;
background-repeat: no-repeat;
border-color: grey;
outline: 0;
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
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1"><b>Role ID:</b></label>
                    </br>
                    <select name="role_id" class="classic">
                        @foreach($roles_id as $key =>$role)
                        @if($role->id==$user->role_id)
                        <option selected value="{{$role->id}}">{{$role->role_name}}</option>
                        @else
                        <option value="{{$role->id}}">{{$role->role_name}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="form-submit" value="Update account" />
                </div>
            </form>
        </div>
</section>

</div>
@endsection
