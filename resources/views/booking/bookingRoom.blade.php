@extends('layouts.main')
@section('title','Booking room')
@section('custom-css')
<style>
    div.hotel_img {
        width: 300px;
        height: 300px;
    }

    .accomodation_item h6 {
        font-size: 20px;
    }
    h6.sec_h6{
        margin-top: 10px ;
    }
    section.hotel_booking_area{
        margin-top:20px;
        padding-left:60px;
    }
    p.set_p{
        font-size:18px;
    }
</style>
@endsection
@section('content')
<section class="breadcrumb_area">
    <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background=""></div>
    <div class="container">
        <div class="page-cover text-center">
            <h2 class="page-cover-tittle">Booking room</h2>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">Home</a></li>
                <li class="active">Booking room</li>
            </ol>
        </div>
    </div>
</section>
<!--================Breadcrumb Area =================-->
<!--================ Accomodation Area  =================-->
<section class="room top" id="room">
    <div class="container">
      <div class="section_title text-center">
        <h2 class="title_color">New Room</h2>
        <p class="set_p"><marquee direction="left" height="50" width="450" bgcolor="#ffffe6">
            We all live in an age that belongs to the young at heart. Life that is becoming extremely fast
        </marquee></p>
      </div>
      @foreach($room as $key => $value)
      <div class="content grid">
        <div class="box">
          <div class="img">
            <img src="{{URL::to('admin/uploads/room/'.$value->room_image)}}" alt="">
          </div>
          <div class="text">
            <h4>Name Room:{{$value->room_name}}</h4>
            <p>{{number_format($value->room_price).' '.'VND/'}}<small><b>night</b></small></p>
            <a href="{{URL::to('/detailRoom/'.$value->id)}}" class="btn theme_btn button_hover">Book Now</a>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>
<!--================ Accomodation Area  =================-->

<!--================Booking Tabel Area =================-->
<section class="hotel_booking_area">
    <div class="container">
        <div class="row hotel_booking_table">
            <div class="col-md-3">
                <h2>Filter <br> rooms</h2>
            </div>
            <div class="col-md-9">
                <div class="boking_table">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="book_tabel_item">
                                <a class="book_now_btn button_hover" href="">All room</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="book_tabel_item">
                                <div class="input-group">
                                    <select class="wide" name="links" size="1" onchange="window.location.href=this.value;">
                                        <option data-display="Room Type">Room Type</option>
                                        @foreach($roomType as $key => $value)
                                        <option value="{{URL::to('/show-roomtype/'.$value->roomtype_id)}}">{{$value->roomtype_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group">
                                    <select class="wide" name="links" size="1" onchange="window.location.href=this.value;">
                                        <option data-display="Kind of Room">Kind of Room</option>
                                        @foreach($kindOfRoom as $key => $value)
                                        <option value="{{URL::to('/show-kindofroom/'.$value->kindofroom_id)}}">{{$value->kindofroom_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================Booking Tabel Area  =================-->

<!--================ Accomodation Area  =================-->
<section class="accomodation_area section_gap">
    <div class="container">
        <div class="section_title text-center">
            <h2 class="title_color">All room in Royal Hotel</h2>
            <p class="set_p"><marquee direction="left" height="50" width="450" bgcolor="#ffffe6">
            We all live in an age that belongs to the young at heart. Life that is becoming extremely fast
            </marquee></p>
        </div>
        @foreach($all_room as $key => $value)
        <div class="content grid">
        <div class="box">
          <div class="img">
            <img src="{{URL::to('admin/uploads/room/'.$value->room_image)}}" alt="">
          </div>
          <div class="text">
            <h4>Name Room:{{$value->room_name}}</h4>
            <p>{{number_format($value->room_price).' '.'VND/'}}<small><b>night</b></small></p>
            <a href="{{URL::to('/detailRoom/'.$value->id)}}" class="btn theme_btn button_hover">Book Now</a>
          </div>
        </div>
        @endforeach
    </div>
</section>
@endsection