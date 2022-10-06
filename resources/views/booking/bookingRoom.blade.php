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
    h2.title_all{
        margin-top:-50px;
    }
    button.search{
      weight:400px;
      margin-bottom:50px;
      text-align: left;
    }
    input.search{
      width: 400px;
      height:40px;
      margin-top:-50px;
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
        <h2 class="title_all">ALL ROOM</h2>
        <p class="set_p"><marquee direction="left" height="50" width="450" bgcolor="#ffffe6">
            We all live in an age that belongs to the young at heart. Life that is becoming extremely fast
        </marquee></p>
      </div>
      <form action="">
      <div class="search">
           <input type="search" name="search" class="form-control search" placeholder="Search by name room or price" value={{$search}}>
              <button class="btn btn-outline-primary search">Search</button>    
           <a href="{{url('/bookingRoom')}}">
              <button type="button" class="btn btn-primary search">Reset</button>
           </a>
      </div>      
      </form>
      <div class="content grid">
      @foreach($all_room as $key => $value)
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
@section('custom-js')
   <script type="text/javascript">
      $(document).ready(function(){
        $('.add-to-cart').click(function(){ 
          swal("here are the messages");
        });

      });
    </script>
@endsection