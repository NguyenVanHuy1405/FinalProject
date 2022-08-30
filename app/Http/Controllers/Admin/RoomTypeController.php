<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomType;
use App\Http\Requests\RoomTypeRequest;
use Session;
use Illuminate\Support\Facades\Redirect;
use Yajra\Datatables\Datatables;
use App\Http\Requests\UpdateRoomTypeRequest as UpdateRequest;

class RoomTypeController extends Controller
{
    public function index(){
        $itemRoomType = RoomType::all();   
        return view('admin.roomtype.index',compact('itemRoomType'));
    }
    public function getDtRowData(Request $request)
    {
        $roomtype = RoomType::all();
        return Datatables::of($roomtype)
            ->editColumn('id', function ($data) {
            return $data->id;
            })
            ->editColumn('roomtype_name', function ($data) {
                return $data->roomtype_name;
            })
            ->editColumn('roomtype_desc', function ($data) {
                return $data->roomtype_desc;
            })
            ->editColumn('roomtype_status', function ($data) {
                if ($data->roomtype_status == 0) 
                {
                    return' <a class="fa-thumb-styling fa fa-thumbs-down btn-lg" href="' . route("admin.roomtype.unactive_roomtype", $data->id).'"></a>';
                }
            else
                {
                    return' <a class="fa-thumb-styling fa fa-thumbs-up btn-lg" href="' . route("admin.roomtype.active_roomtype", $data->id).'"></a>';
                }
            })
            ->editColumn('action', function ($data) {
                return '
                <a class="btn btn-warning btn-sm rounded-pill" href="' . route("admin.roomtype.update", $data->id) . '"><i class="fa-solid fa-pen-to-square" title="Edit Room Type"></i> Edit</a>
                <form method="GET" action="' . route('admin.roomtype.delete', $data->id) . '" accept-charset="UTF-8" style="display:inline-block">
                ' . method_field('GET') .
                    '' . csrf_field() .
                    '<button type="submit" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm(\'Do you want to delete this Room Type ?\')"><i class="fa-solid fa-trash" title="Delete Mission"></i>Delete</button>
                </form>
                ';
            })
            ->rawColumns(['action', 'roomtype_name','roomtype_status'])
            ->setRowAttr([
                'data-row' => function ($data) {
                    return $data->id;
                }
            ])
            ->make(true);
    }
    public function create(RoomTypeRequest $request)
    {
        $data = $request->all();
        $roomtype = new RoomType();
        $roomtype->roomtype_name = $data['roomtype_name'];
        $roomtype->roomtype_desc = $data['roomtype_desc'];
        $roomtype->roomtype_status = $data['roomtype_status'];
        $roomtype->save();
        return Redirect::to('/admin/roomtype/index')->with('success','Add roomtype successfully');
    }
    public function edit($id)
    {
        $roomtype = RoomType::findOrFail($id);
        return view('admin.roomtype.edit', compact('roomtype'));
    }

    public function update(UpdateRequest $request,$id)
    {
        $data = $request->all();
        $roomtype = RoomType::find($id);
        $roomtype->roomtype_name = $data['roomtype_name'];
        $roomtype->roomtype_desc = $data['roomtype_desc'];
        $roomtype->save();
        return Redirect::to('/admin/roomtype/index')->with('success','Update roomtype successfully');
    }

    public function delete($id)
    {
        $data = RoomType::find($id);
        $data->delete();
        return Redirect::to('/admin/roomtype/index')->with('message','Delete roomtype successfully');
    }
    public function unactive_roomtype($id){
        RoomType::where('id',$id)->update(['roomtype_status'=>1]);
        return Redirect::to('/admin/roomtype/index')->with('success','Active roomtype successfully');
    }
    public function active_roomtype($id){
        RoomType::where('id',$id)->update(['roomtype_status'=>0]);
        return Redirect::to('/admin/roomtype/index')->with('message','Unactive roomtype successfully');
    }
    public function show_roomtype($id){
        $roomType = RoomType::where('roomtype_status','1')->orderBy('id','desc')->get();
        $kindofRoom = KindOfRoom::where('kindofroom_status','1')->orderBy('id','desc')->get();
        $roomtype_by_id = Room::join('room_types','rooms.id','=','room_types.id')->where('rooms.id',$id)->get();
        $roomtype_name =RoomType::where('room_types.id',$id)->limit(1)->get();
        return view('booking.showRoomtype',compact('roomType','kindofRoom','roomtype_by_id','roomtype_name'));
    }
}
