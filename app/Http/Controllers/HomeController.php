<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\KindOfRoom;
use App\Models\RoomType;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function booking_room(){
        $roomType = RoomType::where('roomtype_status','1')->orderBy('id','desc')->get();
        $kindOfRoom = KindOfRoom::where('kindofroom_status','1')->orderBy('id','desc')->get();
        $room = Room::where('room_status','1')->orderby('id','desc')->limit(3)->get();
        $all_room = Room::where('room_status','1')->orderby('id','desc')->get();
        return view('booking.bookingRoom',compact('roomType','kindOfRoom','room','all_room'));
    }
    public function detail_room($id){
        $roomType = RoomType::where('roomtype_status','1')->orderBy('id','desc')->get();
        $kindofRoom = KindOfRoom::where('kindofroom_status','1')->orderBy('id','desc')->get();
        $room_id = Room::join('room_types','room_types.id','=','rooms.roomtype_id')->
        join('kind_of_rooms','kind_of_rooms.id','=','rooms.kindofroom_id')->where('rooms.id',$id)->get();
        $room = Room::where('rooms.id',$id)->get();
        foreach($room as $key => $value){
            $roomtype_id = $value->roomtype_id;
         }
     
     $related_room = Room::join('room_types','room_types.id','=','rooms.roomtype_id')->
     join('kind_of_rooms','kind_of_rooms.id','=','rooms.kindofroom_id')
     ->where('room_types.id',$roomtype_id)->whereNotIn('rooms.id',[$id])->get();
     return view('booking.detailRoom',compact('roomType','kindofRoom','room','room_id','related_room'));
    }
}
