@extends('layouts.main')
@section('custom-css')
<style>
	.step-one {
  margin-bottom: -10px
}

.register-req, .step-one .heading {
  background: none repeat scroll 0 0 #F0F0E9;
  color: #363432;
  font-size: 20px;
  margin-bottom: 35px;
  padding: 10px 25px;
  font-family: 'Roboto', sans-serif;
}

.checkout-options {
  padding-left: 20px
}


.checkout-options h3 {
  color: #363432;
  font-size: 20px;
  margin-bottom: 0;
  font-weight: normal;
  font-family: 'Roboto', sans-serif;
}

.checkout-options p {
  color: #434343;
  font-weight: 300;
  margin-bottom: 25px;
}

.checkout-options .nav li {
  float: left;
  margin-right: 45px;
  color: #696763;
  font-size: 18px;
  font-family: 'Roboto', sans-serif;
  font-weight: normal;
}

.checkout-options .nav label {
  font-weight: normal;
}

.checkout-options .nav li a {
  color: #FE980F;
  font-size: 18px;
  font-weight: normal;
  padding: 0
}

.checkout-options .nav li a:hover {
  background: inherit;
}

.checkout-options .nav i {
  margin-right: 10px;
  border-radius: 50%;
  padding: 5px;
  background: #FE980F;
  color:#fff;
  font-size: 14px;
  padding: 2px 3px;
}


.register-req  {
  font-size: 14px;
  font-weight: 300;
  padding: 15px 20px;
  margin-top: 35px;

}

.register-req p {
  margin-bottom: 0
}



.shopper-info p, 
.bill-to p, 
.order-message p {
  color: #696763;
  font-size: 20px;
  font-weight: 300
}


.shopper-info .btn-primary {
  background: #FE980F;
  border: 0 none;
  border-radius: 0;
  margin-right: 15px;
  margin-top: 20px;
}


.form-two, .form-one {
  float: left;
  width: 47%
}


.shopper-info > form > input, 
.form-two > form > select, 
.form-two > form > input, 
.form-one > form > input {
  background:#F0F0E9;
  border: 0 none;
  margin-bottom:10px;
  padding: 10px;
  width: 100%;
  font-weight: 300
}

.form-two > form > select {
  padding:10px 5px
}

.form-two {
  margin-left: 5%
}


.order-message textarea {
  font-size: 12px;
  height: 335px;
  margin-bottom: 20px;
  padding: 15px 20px;
}

.order-message label {
  font-weight:300;
  color: #696763;
  font-family: 'Roboto', sans-serif;
  margin-left: 10px;
  font-size: 14px
}


.review-payment h2 {
  color: #696763;
  font-size: 20px;
  font-weight: 300;
  margin-top: 45px;
  margin-bottom: 20px
}

.payment-options {
  margin-bottom:125px;
  margin-top: -25px
}

.payment-options span label {
  color: #696763;
  font-size: 14px;
  font-weight: 300;
  margin-right: 30px;
}

#cart_items .cart_info 
.table.table-condensed.total-result {
  margin-bottom: 10px;
  margin-top: 35px;
  color: #696763
}

#cart_items .cart_info 
.table.table-condensed.total-result tr {
  border-bottom: 0
}

#cart_items .cart_info 
.table.table-condensed.total-result span {
  color: #FE980F;
  font-weight: 700;
  font-size: 16px
}

#cart_items .cart_info 
.table.table-condensed.total-result 
.shipping-cost {
  border-bottom: 1px solid #F7F7F0;
}
li.active_cart {
        color: black;
        font-family: 'Roboto', sans-serif;
        font-size: 14px;
}
input.booking_info{
	color:black;
	font-size:14px; 
}
::placeholder{
	color:black;
	font-size::14px;
}
.cart_delete  {
  display: block;
  margin-right: 0px;
  overflow: hidden;
}


.cart_delete a {
  background:#F0F0E9;
  color: #FFFFFF;
  padding: 5px 7px ;
  font-size: 16px;
}

.cart_delete a:hover {
  background:#FE980F
}
textarea.note{
	font-size:16px;
}
td.cart_product {
     display: block;
     margin: 30px -70px 10px 20px;
}
span.error{
  margin-top:10px;
  margin-bottom:10px;
}
h2.payment{
    color:#696763;
    padding-bottom:30px;
    font-family: 'Roboto Slab', serif;
}
div.paypal{
  width: 40%;
}
</style>
@endsection
@section('content')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active_cart">Payment</li>
				</ol>
			</div><!--/breadcrums-->
      @if(\Session::has('error'))
        <div class="alert alert-danger">{{ \Session::get('error') }}</div>
        {{ \Session::forget('error') }}
    @endif
    @if(\Session::has('success'))
        <div class="alert alert-success">{{ \Session::get('success') }}</div>
        {{ \Session::forget('success') }}
    @endif
			<div class="review-payment">
				<h2>Review & Payment</h2>
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
	</section>
@endsection
@section('custom-js')
<script>
$("input:checkbox").on('click', function() {
  // in the handler, 'this' refers to the box clicked on
  var $box = $(this);
  if ($box.is(":checked")) {
    // the name of the box is retrieved using the .attr() method
    // as it is assumed and expected to be immutable
    var group = "input:checkbox[name='" + $box.attr("name") + "']";
    // the checked state of the group/box on the other hand will change
    // and the current value is retrieved using .prop() method
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});
</script>
@endsection
