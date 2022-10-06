<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\KindOfRoom;
use App\Models\RoomType;
use Auth;
use File;
use DB;

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
    public function index(Request $request)
    {
        $meta_keywords = "Royal, Royal Hotel";
        $meta_description ="Owning a chain of hotels stretching across Vietnam, meeting most of the needs of guests.";
        $url_canonical = $request->url();
        $meta_title = "Royal Hotel";
        // $image_og = File::get(asset('/home/image/r1.jpg'));
        return view('home',compact('meta_keywords','meta_description','url_canonical','meta_title'));
    }
    public function booking_room(Request $request){
        $meta_keywords = "Royal, Royal Hotel";
        $meta_description ="Owning a chain of hotels stretching across Vietnam, meeting most of the needs of guests.";
        $url_canonical = $request->url();
        $meta_title = "Booking room in Royal Hotel";
        $roomType = RoomType::where('roomtype_status','1')->orderBy('id','desc')->get();
        $kindOfRoom = KindOfRoom::where('kindofroom_status','1')->orderBy('id','desc')->get();
        $room = Room::where('room_status','1')->orderby('id','desc')->limit(3)->get();
        $search = $request['search'] ?? "";
        if ($search != ""){
            $all_room = Room::where('room_name','LIKE',"%$search%")->orWhere('room_price','LIKE',"%$search%")->where('room_status','1')->get(); 
        }
        else{
            $all_room = Room::where('room_status','1')->orderby('id','desc')->get();
        }
        $data = compact('roomType','kindOfRoom','room','all_room','meta_keywords','meta_description','url_canonical','meta_title','search');
        return view('booking.bookingRoom')->with($data);
    }
    public function detail_room($id,Request $request){
        $roomType = RoomType::where('roomtype_status','1')->orderBy('id','desc')->get();
        $kindofRoom = KindOfRoom::where('kindofroom_status','1')->orderBy('id','desc')->get();
        $room_id = Room::join('room_types','room_types.id','=','rooms.roomtype_id')->
        join('kind_of_rooms','kind_of_rooms.id','=','rooms.kindofroom_id')->where('rooms.id','=',$id)->get();
        $room = Room::where('rooms.id',$id)->get();
        foreach($room_id as $key => $value){
            $roomType_id = $value->roomtype_id;
            $meta_keywords = "Royal, Royal Hotel";
            $meta_description =$value->room_description;
            $url_canonical = $request->url();
            $meta_title = "Detail Room Booking";
         }
     $related = Room::where('rooms.id',$id)->where('room_status','1')->first();
     $related_room = Room::join('room_types','room_types.id','=','rooms.roomtype_id')->
     join('kind_of_rooms','kind_of_rooms.id','=','rooms.kindofroom_id')
     ->where('room_types.id',$roomType_id)->whereNotIn('rooms.id',[$id])->get();
     return view('booking.detailRoom',compact('roomType','kindofRoom','room','room_id','related_room','meta_keywords','meta_description','url_canonical','meta_title','related'));
    }
}
