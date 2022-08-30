@extends('layouts.admin')
@section('title','Create Room of Hotel')
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
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Create a new room</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="signup-content">
            <h2 class="form-title">Create a new room</h2>
                <form action="{{URL::to('/admin/room/create')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-lg-15">
                    <div class="form-group @error('room_name') is-invalid @enderror">
                        <label for="room_name"><b>Room Name:</b></label>
                        <input type="text" class="form-control item" name="room_name" id="room_name" placeholder="Enter room name">
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
                        <textarea type="text" rows="5" name="room_description" id="room_description" placeholder="Enter room description"></textarea>
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
                        <label for="room_content"><b>Room Content:</b></label></br>
                        <textarea rows="8"  name="room_content" id="room_content" placeholder="Enter room content"></textarea>
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
                        <input type="text" class="form-control item" name="room_price" id="room_price" placeholder="Enter room price">
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
                        <input type="file" placeholder="Upload room image" class="form-control item" name="room_image" id="room_image">
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
                        <option value="{{$type->id}}">{{$type->roomtype_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1"><b>Kind Of Room:</b></label>
                    </br>
                    <select name="kindofroom_id" class="classic">
                        @foreach($kindofRoom as $key =>$kind) 
                        <option value="{{$kind->id}}">{{$kind->kindofroom_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group @error('room_status') is-invalid @enderror">
                        <label for="room_status"><b>Room status:</b></label>
                        </br>
                        <select name="room_status" class="classic">
                                <option value="0">Hide room</option>
                                <option value="1">Display room</option>
                        </select>
                    </div>
                    @if ($errors->has('room_status'))
                    <span>
                        @error('room_status')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </span>
                    @endif
                <div class="form-group">
                    <input type="submit" class="form-submit" value="Create a new room" />
                </div>
            </form>
        </div>
    </section>

</div>
@endsection