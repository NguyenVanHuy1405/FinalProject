<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\KindOfRoom;
use App\Models\RoomType;
use Session;
use Illuminate\Support\Facades\Redirect;
use Yajra\Datatables\Datatables;
use App\Http\Requests\RoomRequest;
use App\Http\Requests\UpdateRoomRequest as UpdateRoom;

class RoomController extends Controller
{
    public function index(){
        return view(
            'admin.room.index',
            [
                'roomType' => RoomType::all(),
                'kindOfRoom' => KindOfRoom::all(),
            ]
        );
    }
    public function create(){
        $roomType = RoomType::orderBy('id','desc')->get();
        $kindofRoom = KindOfRoom::orderBy('id','desc')->get();
        return view('admin.room.create',compact('roomType','kindofRoom'));
    }
    public function saveroom(RoomRequest $request){
        $data = $request->except(['_token']);
        $room = new Room();
        $room->room_name = $data['room_name'];
        $room->roomtype_id= $data['roomtype_id'];
        $room->kindofroom_id = $data['kindofroom_id'];
        $room->room_description = $data['room_description'];
        $room->room_content = $data['room_content'];
        $room->room_price = $data['room_price'];
        $room->room_image = $data['room_image'];
        $room->room_status = $data['room_status'];
        $get_image = $request->file('room_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('admin/uploads/room',$new_image);
            $data['room_image'] = $new_image;
            Room::insert($data);
            return Redirect::to('/admin/room/index')->with('success','Add room successfully');
        }
        $data['room_image']='';
        Room::insert($data);
        return Redirect::to('/admin/room/index')->with('success','Add room successfully');
    }
    public function getDtRowData(Request $request)
    {
        $room = Room::all();
        return DataTables::of($room)
            ->editColumn('room_name', function ($data) {
                return $data->room_name;
            })
            ->editColumn('roomtype', function ($data) {
                return $data->roomtype->roomtype_name;
            })
            ->editColumn('kindofroom', function ($data) {
                return $data->kindofroom->kindofroom_name;
            })
            ->editColumn('room_price', function ($data) {
                return number_format($data->room_price).''.' VND';
            })
            ->editColumn('room_image', function ($data) {
                $url=asset("admin/uploads/room/$data->room_image"); 
                return '<img src='.$url.' class="images_room" alt="room image" align="center" />';
            })
            
            ->editColumn('room_status', function ($data) {
                if ($data->room_status == 0) 
                {
                    return' <a class="fa-thumb-styling fa fa-thumbs-down btn-lg" href="' . route("admin.room.unactive_room", $data->id).'"></a>';
                }
            else
                {
                    return' <a class="fa-thumb-styling fa fa-thumbs-up btn-lg" href="' . route("admin.room.active_room", $data->id).'"></a>';
                }
            })
            ->editColumn('action', function ($data) {
                return '
                <a class="btn btn-warning btn-sm rounded-pill" href="' . route("admin.room.update", $data->id) . '"><i class="fa-solid fa-pen-to-square" title="Edit Room"></i> Edit</a>
                <form method="GET" action="' . route('admin.room.delete', $data->id) . '" accept-charset="UTF-8" style="display:inline-block">
                ' . method_field('GET') .
                    '' . csrf_field() .
                    '<button type="submit" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm(\'Do you want to delete this Room?\')"><i class="fa-solid fa-trash" title="Delete Mission"></i>Delete</button>
                </form>
                ';
            })
            ->rawColumns(['action', 'room_name','room_image','room_status'])
            ->setRowAttr([
                'data-row' => function ($data) {
                    return $data->id;
                }
            ])
            ->make(true);
    }
    public function delete($id)
    {
        $data = Room::find($id);
        $data->delete();
        return Redirect::to('/admin/room/index')->with('message','Delete room successfully');
    }
    public function unactive_room($id){
        Room::where('id',$id)->update(['room_status'=>1]);
        return Redirect::to('/admin/room/index')->with('success','Active room successfully');
    }
    public function active_room($id){
        Room::where('id',$id)->update(['room_status'=>0]);
        return Redirect::to('/admin/room/index')->with('message','Unactive room successfully');
    }
    public function edit($id){
        $roomItem = Room::findOrFail($id);
        $roomType = RoomType::orderBy('id','desc')->get();
        $kindofRoom = KindOfRoom::orderBy('id','desc')->get();
        return view('admin.room.edit', compact('roomItem','roomType','kindofRoom'));
    }
    public function update(UpdateRoom $request,$id){
        $data = $request->except(['_token']);
        $room = Room::find($id);
        $room->room_name = $data['room_name'];
        $room->roomtype_id= $data['roomtype_id'];
        $room->kindofroom_id = $data['kindofroom_id'];
        $room->room_description = $data['room_description'];
        $room->room_content = $data['room_content'];
        $room->room_price = $data['room_price'];
        $room->room_image = $data['room_image'];
        $get_image = $request->file('room_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('admin/uploads/room',$new_image);
            $data['room_image'] = $new_image;
            Room::where('id',$id)->update($data);
            return Redirect::to('/admin/room/index')->with('success','Update room successfully');
        }
        $data['room_image']='';
        Room::where('id',$id)->update($room);
        return Redirect::to('/admin/room/index')->with('success','Update room successfully');
    }
    public function listRoomByRoomType($id){
        $room_type = RoomType::find($id);
        if (!$room_type) abort(404); 
        return view(
            'admin.room.indexbyRoomType',
            [
                'room_type' => $room_type
            ]
        );
    }
    public function getDtRowDataByRoomType($id){
        $roomType = Room::where('roomtype_id', $id)->get();
        return Datatables::of($roomType)
            ->editColumn('room_name', function ($data) {
                return $data->room_name;
            })
            ->editColumn('room_price', function ($data) {
                return $data->room_price;
            })
            ->editColumn('room_content', function ($data) {
                return $data->room_content;
            })
            ->editColumn('room_image', function ($data) {
                $url=asset("admin/uploads/room/$data->room_image"); 
                return '<img src='.$url.' class="images_room" alt="room image" align="center" />';
            })
            ->rawColumns(['room_image'])
            ->setRowAttr([
                'data-row' => function ($data) {
                    return $data->id;
                }
            ])
            ->make(true);
    }
    public function listRoomByKindOfRoom($id){
        $kind_of_room = KindOfRoom::find($id);
        if (!$kind_of_room) abort(404); 
        return view(
            'admin.room.indexbyKindOfRoom',
            [
                'kind_of_room' => $kind_of_room
            ]
        );
    }
    public function getDtRowDataByKindOfRoom($id){
        $kindOfRoom = Room::where('kindofroom_id', $id)->get();
        return Datatables::of($kindOfRoom)
            ->editColumn('room_name', function ($data) {
                return $data->room_name;
            })
            ->editColumn('room_price', function ($data) {
                return $data->room_price;
            })
            ->editColumn('room_content', function ($data) {
                return $data->room_content;
            })
            ->editColumn('room_image', function ($data) {
                $url=asset("admin/uploads/room/$data->room_image"); 
                return '<img src='.$url.' class="images_room" alt="room image" align="center" />';
            })
            ->rawColumns(['room_image'])
            ->setRowAttr([
                'data-row' => function ($data) {
                    return $data->id;
                }
            ])
            ->make(true);
    }
}
