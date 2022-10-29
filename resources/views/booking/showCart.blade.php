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

    input.form-control {
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

    div.coupon {
        margin-left: 160px;
        margin-top: -30px;
    }

    h4.header-coupon {
        background: #FE980F;
        height: 50px;
        margin-right: 170px;
        padding-top: 10px;
        padding-left: 15px;
        color: white;
    }

    p.coupon-text {
        font-weight: bold;
        font-size: 16px;
    }

    div.alert-danger {
        margin-right: 170px;
    }

    a.delete-coupon {
        margin-top: 20px;
        border: none;
    }
    button.login-modal{
        margin-left:40px;
        margin-top:-5px;
    }
    input.email{
        width:450px;
    } 
    input.password{
        width:450px;
    }
    div.alert-danger{
        width:450px;
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
                            $total_coupon = ($after_total *$cou['coupon_number'])/100;
                            echo '
                        <li>Total Coupon <span>'.number_format($total_coupon,0,',','.').' '.'VND'.'<span></li>';
                        $total = $after_total - $total_coupon;
                        echo'<li>Total<span>'.number_format($total,0,',','.').' '.'VND'.'</span></li>';
                        @endphp
                        @elseif($cou['coupon_condition']==2)
                        Coupon code <span>{{number_format($cou['coupon_number'],0,',','.')}} VND</span>
                        @php
                        $total_coupon = $cou['coupon_number'];
                        echo '<li>Total Coupon <span>'.number_format($total_coupon,0,',','.').' '.'VND'.'<span></li>';
                        $total = $after_total - $total_coupon;
                        echo'<li>Total<span>'.number_format($total,0,',','.').' '.'VND'.'</span></li>';
                        @endphp
                        @endif
                        @endforeach
                        @else
                        Total <span>{{Cart::total(0,',','.').' '.'VND'}}</span>
                        @endif
                        </li>

                    </ul>
                    @if (!auth()->user())
                    <button type="button" class="btn btn-danger login-modal" data-toggle="modal" data-target="#exampleModal">
                        Login to checkout
                    </button>
                    @else
                    <a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Check Out</a>
                    @endif
                    @if(Session::has('coupon'))
                    <a class="btn btn-danger delete-coupon" href="{{URL::to('/delete-coupon')}}">Delete coupon</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" role="form">
                    <div id="error"></div>
                    <div class="form-group">
                        <label for="">Email:</label>
                        <input type="text" class="form-control email" id="email" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="">Password:</label>
                        <input type="password" class="form-control password" id="password" placeholder="Enter your password">
                    </div>

                    <button type="button" class="btn btn-primary btn-block" id="btn-login">Login</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom-js')
<script>
    var _csrf = '{{csrf_token()}}';
    $('#btn-login').click(function(ev) {
        ev.preventDefault();
        var _loginUrl = '{{route("ajax.login_to_checkout")}}';
        var email = $('#email').val();
        var password = $('#password').val();

        $.ajax({
            url: _loginUrl
            , type: 'POST'
            , data: {
                email: email
                , password: password
                , _token: _csrf
            , }
            , success: function(res) {
                if (res.error) {
                    let _html_error = '<div class="alert alert-danger">';
                    for (let error of res.error) {
                        _html_error += `<li>${error}</li>`;
                    }
                    _html_error += '</div>';
                    $('#error').html(_html_error);
                } else {
                    alert('Login Successfully');
                    location.reload();
                }
            }
        });
    });
</script>
@endsection
