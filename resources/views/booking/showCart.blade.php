@extends('layouts.main')
@section('title','Show booking room')
@section('custom-css')
<style>
    li.active_cart {
        color: black;
        font-family: 'Roboto', sans-serif;
        font-size: 14px;
    }

    .cart_quantity_input {
        color: #696763;
        float: left;
        font-size: 16px;
        text-align: center;
        font-family: 'Roboto', sans-serif;

    }
    td.cart_product {
     display: block;
     margin: 30px -70px 10px 20px;
}
    input.form-control{
    display: block;
    width: 500px;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-image: none;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
    }
    div.coupon{
        margin-left:160px;
        margin-top:-30px;
    }
    h4.header-coupon{
        background:#FE980F;
        height: 50px;
        margin-right:170px;
        padding-top:10px;
        padding-left:15px;
        color:white;
    }
    p.coupon-text{
        font-weight:bold;
        font-size:16px;
    }
    div.alert-danger{
        margin-right:170px;
    }
    a.delete-coupon{
        margin-top:20px;
        border: none;
    }
</style>
@endsection
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active_cart">Show booking room</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <?php
              $content = Cart::content();
            ?>
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Room</td>
                        <td class="name">Room Name</td>
                        <td class="price">Price</td>
                        <td class="quantity">Total days in hotel</td>
                        <td class="total">Total price</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($content as $value)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{URL::to('admin/uploads/room/'.$value->options->image)}}" alt="" width="80px" height="50px"></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$value->name}}</a></h4>
                            <p>Web ID: 1089772</p>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($value->price).''.'VND'}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <form action="{{URL::to('/update-cart')}}" method="post">
                                    {{ csrf_field() }}
                                <input class="cart_quantity_input" type="text" name="cart_quantity" value="{{$value->qty}}">
                                <input type="hidden" value="{{$value->rowId}}" name="rowId_cart" class="form control">
                                <input type="submit" value="Update" name="update_qty" class="btn btn-primary btn-sm">
                               </form>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                                <?php
                                   $total_price = $value->price * $value->qty;
                                   echo number_format($total_price).' '.'VND';
                                ?>
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$value->rowId)}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="coupon">
        <h4 class="header-coupon">Enter your coupon</h4>
        @include('layouts.alertProfile')
        <p class="coupon-text">Search or enter your coupon to get a discount.</p>
        <form action="{{route('checkCoupon')}}" method="post">
            {{csrf_field()}}
            <input type="text" class="form-control" name="coupon" placeholder="Enter code coupon">
            <br>
            <input type="submit" class="btn btn-primary check_coupon" name="check_coupon" value="Submit coupon">
        </form>
    </div>
</section>
<!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Cart Sub Total <span>{{Cart::priceTotal(0,',','.').' '.'VND'}}</span></li>
                        <li>Eco Tax <span>{{Cart::tax(0,',','.').' '.'VND'}}</span></li>
                        <li>
                        @if(Session::get('coupon'))
                          @foreach(Session::get('coupon') as $key => $cou)
                            @if($cou['coupon_condition']==1)  
                              Coupon code <span>{{$cou['coupon_number']}} %</span> 
                                @php
                                  $total_price = $value->price * $value->qty;
                                  $total_coupon = ($total_price *$cou['coupon_number'])/100;
                                  echo '<li>Total Coupon <span>'.number_format($total_coupon,0,',','.').' '.'VND'.'<span></li>';
                                  $total = $total_price - $total_coupon;
                                  echo'<li>Total<span>'.number_format($total,0,',','.').' '.'VND'.'</span></li>';
                                @endphp 
                            @elseif($cou['coupon_condition']==2)  
                              Coupon code <span>{{number_format($cou['coupon_number'],0,',','.')}} VND</span> 
                                @php
                                  $total_coupon = ($cou['coupon_number']);
                                  echo '<li>Total Coupon <span>'.number_format($total_coupon,0,',','.').' '.'VND'.'<span></li>';
                                  $total = $total_price - $total_coupon;
                                  echo'<li>Total<span>'.number_format($total,0,',','.').' '.'VND'.'</span></li>';
                                @endphp     
                            @endif
                          @endforeach
                        @endif   
                        </li>

                    </ul>
                    @if (!auth()->user())
                    <a class="btn btn-default check_out"  href="{{URL::to('/loginCustomer')}}">Check Out</a>
                    @else
                    <a class="btn btn-default check_out"  href="{{URL::to('/checkout')}}">Check Out</a>
                    @endif
                    <a class="btn btn-danger delete-coupon"  href="{{URL::to('/delete-coupon')}}">Delete coupon</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection