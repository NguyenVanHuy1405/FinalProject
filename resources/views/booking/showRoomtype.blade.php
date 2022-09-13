@extends('layouts.main')
@section('custom-css')
<style>
    div.hotel_img{
        width: 300px;
        height: 300px;
    }
    .accomodation_item h6{
        font-size:20px;
    }
    a.btn_primary{
        background-color:yellowgreen;
        font-size: 20px;
    }

</style>
@endsection
@section('title','Show room type')
@section('content')
<section class="breadcrumb_area">
    <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background=""></div>
    <div class="container">
        <div class="page-cover text-center">
            <h2 class="page-cover-tittle">Show room by room type</h2>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/bookingroom')}}">Booking room</a></li>
                <li class="active">Show room by room type</li>
            </ol>
        </div>
    </div>
</section>
<!--================Breadcrumb Area =================-->

<!--================ Accomodation Area  =================-->
<section class="room top" id="room">
    <div class="container">
      <div class="section_title text-center">
      @foreach($roomtype_name as $key => $name)
        <h2 class="title_color">{{$name->roomtype_name}}</h2>
      @endforeach  
        <p class="set_p"><marquee direction="left" height="50" width="450" bgcolor="#ffffe6">
            We all live in an age that belongs to the young at heart. Life that is becoming extremely fast
        </marquee></p>
      </div>
      <div class="content grid">
      @foreach($roomtype_by_id as $key => $value)
        <div class="box">
          <div class="img">
            <img src="{{URL::to('admin/uploads/room/'.$value->room_image)}}" alt="">
          </div>
          <div class="text">
            <h4>{{$value->room_name}}</h4>
            <p>{{number_format($value->room_price).' '.'VND/'}}<small><b>night</b></small></p>
            <a href="{{URL::to('/detailRoom/'.$value->id)}}" class="btn theme_btn button_hover">Book Now</a>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>
@endsection