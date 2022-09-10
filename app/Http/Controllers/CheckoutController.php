<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\User;
use App\Models\Order;
use App\Models\Order_detail;
use Illuminate\Http\Request;
use App\Http\Requests\BookingRequest;
use Illuminate\Support\Facades\Auth;
use Session;
use Cart;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function checkout(){
        return view('checkout.show_checkout');
    }
    public function save_checkout(BookingRequest $request){
        $data = array();
        $data['booking_name'] = $request->booking_name;
        $data['booking_email'] = $request->booking_email;
        $data['booking_address'] = $request->booking_address;
        $data['booking_number'] = $request->booking_phone;
        $data['booking_notes'] = $request->booking_note;
        
        $booking_id = Booking::insertGetId($data);
        Session::put('booking_id',$booking_id);
        return Redirect::to('/payment');
    }
    public function payment(){
        return view('checkout.payment');
    }
    public function order_place(Request $request){
        //payment
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Pending';
        $payment_id = Payment::insertGetId($data);

        //order

        $order_data = array();
        $order_data['user_id']=  Auth::user()->id;
        $order_data['booking_id'] = Session::get('booking_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Pending';
        $order_id = Order::insertGetId($order_data);

        //order_detail
        $content = Cart::content();
        foreach($content as $v_content){
            $order_d_data['order_id'] = $order_id;
            $order_d_data['room_id'] = $v_content->id;
            $order_d_data['room_name'] = $v_content->name;
            $order_d_data['room_price'] = $v_content->price;
            $order_d_data['room_sales_quantity'] = $v_content->qty;
            Order_detail::insert($order_d_data);
        }
        if( $data['payment_method'] == 1){
            echo 'Payment by ATM card';
        }elseif($data['payment_method'] == 2){
            Cart::destroy();
            return view('checkout.handCash');
        }
        else{
            echo 'Payment by Paypal';
        }
    }
}
