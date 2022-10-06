<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CartRequest;
use App\Models\Room;
use App\Models\Coupon;
use Session;
use Cart;
class CartController extends Controller
{
    public function save_cart(CartRequest $request){
        $roomId = $request->roomId_hidden;
        $arrivalDate = Carbon::parse($request->arrivalDate);
        $departureDate = Carbon::parse($request->departureDate);
        $quantity =  $departureDate->setTime(0,0)->diff( $arrivalDate)->format("%a");
        $room_info = Room::where('id',$roomId)->first();
        $data['id'] = $room_info->id;
        $data['qty'] = $quantity;
        $data['name'] = $room_info->room_name;
        $data['price'] = $room_info->room_price;
        $data['weight'] = $room_info->room_price;
        $data['options']['image'] = $room_info->room_image;
        $totalPrice = $data['price'] * $data['qty'];
        Cart::add($data);
        Cart::setGlobalTax(0);
        return Redirect::to('/show-cart');
    }
    public function show_cart(Request $request){
        $total = Cart::total();
        $after_total= (float)str_replace(',', '', $total);
        $meta_keywords = "Royal, Royal Hotel";
        $meta_description ="Owning a chain of hotels stretching across Vietnam, meeting most of the needs of guests.";
        $url_canonical = $request->url();
        $meta_title = "Royal Hotel";      
        return view('booking.showCart',compact('meta_keywords','meta_description','url_canonical','meta_title','after_total'));
    }
    public function payment(Request $request){
        $total = Cart::total();
        $after_total= (float)str_replace(',', '', $total);
        $meta_keywords = "Royal, Royal Hotel, Checkout booking room";
        $meta_description ="Owning a chain of hotels stretching across Vietnam, meeting most of the needs of guests.";
        $url_canonical = $request->url();
        $meta_title = "Payment for booking room";
        return view('checkout.payment',compact('meta_keywords','meta_description','url_canonical','meta_title','after_total'));
    }
    public function delete_cart($rowId){ 
        Cart::update($rowId,0);
        return Redirect::to('/show-cart');
    }
    public function update_cart(Request $request){
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;
        Cart::update($rowId,$qty);
        return Redirect::to('/show-cart');
    }
  public function check_coupon(Request $request)
  {
    $data = $request->all();
    $now = Carbon::now()->format('Y-m-d');
    $coupon = Coupon::where('coupon_code',$data['coupon'])->where('coupon_date_end','>=',$now)->first();
    if($coupon){
        $count_coupon = $coupon->count();
        if($count_coupon > 0){
            $coupon_session = Session::get('coupon');
            if($coupon_session==true){
                $is_avaiable = 0;
                if($is_avaiable==0){
                    $cou[] = array(
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_condition' => $coupon->coupon_condition,
                        'coupon_number' => $coupon->coupon_number,
                    );
                    Session::put('coupon',$cou);
                }
            }else{
                $cou[] = array(
                    'coupon_code' => $coupon->coupon_code,
                    'coupon_condition' => $coupon->coupon_condition,
                    'coupon_number' => $coupon->coupon_number,
                );
                Session::put('coupon',$cou);
            }
            Session::save();
            return redirect()->back()->with('success','Add coupon success');
        } 
    }else{
        return redirect()->back()->with('message','There is no coupon with this code or the coupon has expired.');
    } 
  }
  public function deleteCoupon(){
    $coupon = Session::get('coupon');
    if($coupon == true){
        Session::forget('coupon');
        return redirect()->back()->with('success','Delete coupon success');
    }
  }
}
