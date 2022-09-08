<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use App\Models\Booking;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout(){
        return view('checkout.show_checkout');
    }
    public function save_checkout(Request $request){
        $booking_name = $request->booking_name;
        $booking_email = $request->booking_email;
        $booking_address = $request->booking_address;
        $booking_phone = $request->booking_phone;
        $booking_notes = $request->booking_note;
        $new_booking = Booking::create([
            'booking_name' => $booking_name,
            'booking_email' => $booking_email,
            'booking_address' => $booking_address,
            'booking_phone' => $booking_phone,
            'booking_notes' => $booking_notes,
        ]);
        return Redirect::to('/payment');
    }
    public function payment(){

    }
}
