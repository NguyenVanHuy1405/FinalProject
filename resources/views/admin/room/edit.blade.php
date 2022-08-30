@extends('layouts.admin')
@section('title','Edit a room Hotel')
@section('custom-css')
<link rel="stylesheet" href="{{asset('admin/roomtype/fonts/material-icon/css/material-design-iconic-font.min.css')}}">

<link rel="stylesheet" href="{{asset('admin/roomtype/css/style.css')}}">
<style>
    div.signup-content {
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
        <!-- <img src="images/signup-bg.jpg" alt=""> -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit a room</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="signup-content">
            <form action="{{URL::to('/admin/room/update/'.$roomItem->id)}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
                <h2 class="form-title">Edit a room</h2>
                <div class="col-lg-15">
                    <div class="form-group @error('room_name') is-invalid @enderror">
                        <label for="room_name"><b>Room Name:</b></label>
                        <input type="text" class="form-control item" name="room_name" id="room_name" value="{{$roomItem->room_name}}">
                    </div>
                    @if ($errors->has('room_name'))
                    <span>
                        @error('room_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                    @endif
                </div>
                <div class="col-lg-15">
                    <div class="form-group @error('room_description') is-invalid @enderror">
                        <label for="room_description"><b>Room Description:</b></label>
                        <input type="text" class="form-control item" name="room_description" id="room_description" value="{{$roomItem->room_description}}">
                    </div>
                    @if ($errors->has('room_description'))
                    <span>
                        @error('room_desccriptiom')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                    @endif
                </div>
                <div class="col-lg-15">
                    <div class="form-group @error('room_content') is-invalid @enderror">
                        <label for="room_content"><b>Room Content:</b></label>
                        <textarea style="resize: none" rows="8" class="form-control" name="room_content" id="room_content">{{$roomItem->room_content}}</textarea>
                    </div>
                    @if ($errors->has('room_content'))
                    <span>
                        @error('room_content')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                    @endif
                </div>
                <div class="col-lg-15">
                    <div class="form-group @error('room_price') is-invalid @enderror">
                        <label for="room_price"><b>Room Price:</b></label>
                        <input type="text" class="form-control item" name="room_price" id="room_price" value="{{$roomItem->room_price}}">
                    </div>
                    @if ($errors->has('room_price'))
                    <span>
                        @error('room_price')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                    @endif
                </div>
                <div class="col-lg-15">
                    <div class="form-group @error('room_image') is-invalid @enderror">
                        <label for="room_image"><b>Room image:</b></label>
                        <input type="file" class="form-control item" name="room_image" id="room_image">
                        <img src="{{URL::to('admin/uploads/room/'.$roomItem->room_image)}}" height="150" width="100" ></img>
                    </div>
                    @if ($errors->has('room_image'))
                    <span>
                        @error('room_image')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1"><b>Room Type:</b></label>
                    </br>
                    <select name="roomtype_id" class="classic">
                        @foreach($roomType as $key =>$type) 
                        <option value="{{$type->roomtype_id}}">{{$type->roomtype_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1"><b>Kind Of Room:</b></label>
                    </br>
                    <select name="kindofroom_id" class="classic">
                        @foreach($kindofRoom as $key =>$kind) 
                        <option value="{{$kind->kindofroom_id}}">{{$kind->kindofroom_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="form-submit" value="Update room" />
                </div>
            </form>
        </div>
    </section>

</div>
@endsection