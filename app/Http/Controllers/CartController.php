<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CartRequest;
use App\Models\Room;
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
        Cart::add($data);
        Cart::setGlobalTax(0);
        return Redirect::to('/show-cart');
    }
    public function show_cart(){
        return view('booking.showCart');
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
}