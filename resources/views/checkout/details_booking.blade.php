@extends('layouts.main')
@section('custom-css')
<style>
    .gradient-custom {
        /* fallback for old browsers */
        background: #cd9cf2;

        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to top left, rgba(205, 156, 242, 1), rgba(246, 243, 255, 1));

        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to top left, rgba(205, 156, 242, 1), rgba(246, 243, 255, 1))
    }

    .bn39 {
        background-image: linear-gradient(135deg, #008aff, #86d472);
        border-radius: 6px;
        box-sizing: border-box;
        color: #ffffff;
        display: block;
        height: 50px;
        font-size: 1.4em;
        font-weight: 600;
        padding: 4px;
        position: relative;
        text-decoration: none;
        width: 5em;
        z-index: 2;
    }

    .bn39:hover {
        color: #fff;
    }

    .bn39 .bn39span {
        align-items: center;
        background: #0e0e10;
        border-radius: 6px;
        display: flex;
        justify-content: center;
        height: 100%;
        transition: background 0.5s ease;
        width: 100%;
    }

    .bn39:hover .bn39span {
        background: transparent;
    }

    img.img-fluid {
        border-radius: 15px;
    }

    div.px-4 {
        margin-top: 40px;
        text-align: center;
    }

</style>
@endsection
@section('content')
<section class="h-100 gradient-custom">
    <div class="container history-booking">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12">
                <div class="card" style="border-radius: 10px;">
                    <div class="card-header px-4 py-5">
                        <h5 class="text-muted thanks">Detail booking</h5>
                    </div>
                    <div class="card-body history">
                        @foreach($detail_booking as $key => $value)
                        <div class="card shadow-0 border mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2 image">
                                        <img src="{{URL::to('home/image/history_booking.jpg')}}" class="img-fluid" alt="Room Image">
                                    </div>
                                    <div class="col-md-3 text-center d-flex justify-content-center align-items-center">
                                        <p class="text-muted mb-0"><b>Room Name: </b><br><br>{{$value->room_name}}</p>
                                    </div>
                                    <div class="col-md-3 text-center d-flex justify-content-center align-items-center">
                                        <p class="text-muted mb-0"><b>Room Price: </b><br><br>{{number_format($value->room_price).''.' VND'}}</p>
                                    </div>
                                    <div class="col-md-3 text-center d-flex justify-content-center align-items-center">
                                        <p class="text-muted mb-0"><b>Date At Home: </b><br><br>{{$value->room_sales_quantity}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection
