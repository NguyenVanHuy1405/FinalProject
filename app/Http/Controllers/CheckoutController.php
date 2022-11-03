<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Payment;
use App\Models\Room;
use App\Models\User;
use App\Models\Role;
use App\Models\Statistics;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Session;
use Illuminate\Support\Carbon;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function checkout(Request $request)
    {
        $after_booking= Cart::total();
        $after_total = (float) str_replace(',', '', $after_booking);
        $meta_keywords = "Royal, Royal Hotel, Checkout booking room";
        $meta_description = "Owning a chain of hotels stretching across Vietnam, meeting most of the needs of guests.";
        $url_canonical = $request->url();
        $meta_title = "Checkout booking room";
        return view('checkout.show_checkout', compact('meta_keywords', 'meta_description', 'url_canonical', 'meta_title', 'after_total'));
    }
    public function save_checkout(BookingRequest $request)
    {
        $total = Session::get('total');
        $order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $data = array();
        $data['booking_name'] = $request->booking_name;
        $data['booking_email'] = $request->booking_email;
        $data['booking_address'] = $request->booking_address;
        $data['booking_number'] = $request->booking_phone;
        $data['booking_notes'] = $request->booking_note;

        $booking_id = Booking::insertGetId($data);
        Session::put('booking_id', $booking_id);

        //payment

        $data = array();
        $data['payment_method'] = $request->payment_method;
        $data['payment_status'] = 'Pending';
        $payment_id = Payment::insertGetId($data);

        //order

        $order_data = array();
        $order_data['user_id'] = Auth::user()->id;
        $order_data['booking_id'] = Session::get('booking_id');
        $order_data['payment_id'] = $payment_id;
        if (Session::get('coupon')) {
            $order_data['order_total'] = $total;
        } else {
            $total_no_coupon= Cart::total();
            $after_total = (float) str_replace(',', '', $total_no_coupon);
            $order_data['order_total'] = $after_total;
        }
        $order_data['coupon_booking'] = $request->coupon;
        $order_data['coupon_code'] = $request->coupon_code;
        if (Session::get('coupon')){
            $coupon = Coupon::where('coupon_code', $order_data['coupon_code'])->first();
            $coupon->coupon_time = $coupon->coupon_time-1;
            $coupon->save();
        }
        $order_data['order_status'] = 'Pending';
        $order_data['date_order'] = $order_date;
        $order_id = Order::insertGetId($order_data);

        //order_detail
        $content = Cart::content();
        foreach ($content as $v_content) {
            $order_d_data['order_id'] = $order_id;
            $order_d_data['room_id'] = $v_content->id;
            $order_d_data['room_name'] = $v_content->name;
            $order_d_data['room_price'] = $v_content->price;
            $order_d_data['room_sales_quantity'] = $v_content->qty;
            Room::where('id', $order_d_data['room_id'])->update(['room_status' => 0]);
            Order_detail::insert($order_d_data);
        }
         
        $total_order = Order::where('id', $order_id)->get();
        $total = 0;
        foreach($total_order as $key ){
            $total +=1;
        }
        $statistic_new = new Statistics();
        $statistic_new->order_date = $order_date;
        $statistic_new->total_order = $total;
        $statistic_new->save();
        Cart::destroy();
        Session::forget('successTransaction');
        Session::forget('coupon');
        return Redirect::to('historyBooking')->with('success','Booking rooms successfully');
    }
    public function order_place(Request $request)
    {
        //meta seo
        $meta_keywords = "Royal, Royal Hotel, Checkout booking room";
        $meta_description = "Owning a chain of hotels stretching across Vietnam, meeting most of the needs of guests.";
        $url_canonical = $request->url();
        $meta_title = "Payment for booking room";
        //payment

        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Pending';
        $payment_id = Payment::insertGetId($data);

        //order

        $order_data = array();
        $order_data['user_id'] = Auth::user()->id;
        $order_data['booking_id'] = Session::get('booking_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Pending';
        $order_id = Order::insertGetId($order_data);

        //order_detail
        $content = Cart::content();
        foreach ($content as $v_content) {
            $order_d_data['order_id'] = $order_id;
            $order_d_data['room_id'] = $v_content->id;
            $order_d_data['room_name'] = $v_content->name;
            $order_d_data['room_price'] = $v_content->price;
            $order_d_data['room_sales_quantity'] = $v_content->qty;
            Room::where('id', $order_d_data['room_id'])->update(['room_status' => 0]);
            Order_detail::insert($order_d_data);
        }
        if ($data['payment_method'] == 1) {
            echo 'Payment by ATM card';
        } elseif ($data['payment_method'] == 2) {
            Cart::destroy();
            return view('checkout.handCash', compact('meta_keywords', 'meta_description', 'url_canonical', 'meta_title'));
        } else {
            echo 'Payment by Paypal';
        }
    }
    public function vnpay_payment()
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/checkout";
        $vnp_TmnCode = "S2XHU1MP"; 
        $vnp_HashSecret = "WDEHYLMTJRBDMPGXVEWWVABFQWBCOFEV";

        $vnp_TxnRef = '14052001'; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toán đơn hàng test';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = 20000 * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
//Add Params of 2.0.1 Version
//Billing        
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

//var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }
    public function history(Request $request){
        $meta_keywords = "Royal, Royal Hotel, Checkout booking room";
        $meta_description = "Owning a chain of hotels stretching across Vietnam, meeting most of the needs of guests.";
        $url_canonical = $request->url();
        $meta_title = "History Booking Rooms";
        $role = Role::where('role_name', Role::ROLE_USER)->first()->id;
        if(Auth::user()->role_id==$role){
            $get_order = Order::where('user_id',[Auth::user()->id])->orderby('id','DESC')->get();
            return view('checkout.history',compact('meta_keywords', 'meta_description', 'url_canonical', 'meta_title','get_order'))->with('success','Thank you for booking with us. Below is your booking history.');
        }
        else{
            return Redirect::to('/login')->with('message', 'Please try again with account user');
        }
    }
    public function history_order_details(Request $request,$id){
        $meta_keywords = "Royal, Royal Hotel, Checkout booking room";
        $meta_description = "Owning a chain of hotels stretching across Vietnam, meeting most of the needs of guests.";
        $url_canonical = $request->url();
        $meta_title = "Detail History Booking Rooms";
        $detail_booking = Order_detail::where('order_id',$id)->get();
        return view('checkout.details_booking',compact('meta_keywords', 'meta_description', 'url_canonical', 'meta_title','detail_booking'));
    }
}
