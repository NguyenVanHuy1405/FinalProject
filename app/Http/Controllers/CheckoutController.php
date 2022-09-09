<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\BookingRequest;

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
        $booking_name = $request->booking_name;
        $booking_email = $request->booking_email;
        $booking_address = $request->booking_address;
        $booking_phone = $request->booking_phone;
        $booking_notes = $request->booking_note;
        $new_booking = Booking::create([
            'booking_name' => $booking_name,
            'booking_email' => $booking_email,
            'booking_address' => $booking_address,
            'booking_number' => $booking_phone,
            'booking_notes' => $booking_notes,
        ]);
        return Redirect::to('/payment');
    }
    public function payment(){
        return view('checkout.payment');
    }
}
