<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KindOfRoom;
use App\Models\Room;
use App\Models\RoomType;
use Yajra\Datatables\Datatables;
use App\Http\Requests\KindOfRoomRequest;
use App\Http\Requests\UpdateKindofRoomRequest as UpdateKindofRoom;
use Illuminate\Support\Facades\Redirect;

class KindofRoomController extends Controller
{
    public function index(){
        $itemKindofRoom = KindOfRoom::all();
        return view('admin.kindofroom.index',compact('itemKindofRoom'));
    }
    public function getDtRowData(Request $request)
    {
        $kindofroom = KindOfRoom::all();
        return Datatables::of($kindofroom)
            ->editColumn('id', function ($data) {
            return $data->id;
            })
            ->editColumn('kindofroom_name', function ($data) {
                return $data->kindofroom_name;
            })
            ->editColumn('kindofroom_desc', function ($data) {
                return $data->kindofroom_desc;
            })
            ->editColumn('kindofroom_status', function ($data) {
            if ($data->kindofroom_status == 0) 
                {
                    return' <a class="fa-thumb-styling fa fa-thumbs-down btn-lg" href="' . route("admin.kindofroom.unactive_kindofroom", $data->id).'"></a>';
                }
            else
                {
                    return' <a class="fa-thumb-styling fa fa-thumbs-up btn-lg" href="' . route("admin.kindofroom.active_kindofroom", $data->id).'"></a>';
                }
            })
            ->editColumn('action', function ($data) {
                return '
                <a class="btn btn-warning btn-sm rounded-pill" href="' . route("admin.kindofroom.update", $data->id) . '"><i class="fa-solid fa-pen-to-square" title="Edit Room Type"></i> Edit</a>
                <form method="GET" action="' . route('admin.kindofroom.delete', $data->id) . '" accept-charset="UTF-8" style="display:inline-block">
                ' . method_field('GET') .
                    '' . csrf_field() .
                    '<button type="submit" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm(\'Do you want to delete this kind of room ?\')"><i class="fa-solid fa-trash" title="Delete Mission"></i>Delete</button>
                </form>
                ';
            })
            ->rawColumns(['action', 'kindofroom_name','kindofroom_status'])
            ->setRowAttr([
                'data-row' => function ($data) {
                    return $data->id;
                }
            ])
            ->make(true);
    }
    public function create(KindOfRoomRequest $request)
    {
        $data = $request->all();
        $kindofroom = new KindOfRoom();
        $kindofroom->kindofroom_name = $data['kindofroom_name'];
        $kindofroom->kindofroom_desc = $data['kindofroom_desc'];
        $kindofroom->kindofroom_status = $data['kindofroom_status'];
        $kindofroom->save();
        return Redirect::to('/admin/kindofroom/index')->with('success','Add kind of room successfully');
    }
    public function edit($id)
    {
        $kindofroom = KindOfRoom::findOrFail($id);
        return view('admin.kindofroom.edit', compact('kindofroom'));
    }

    public function update(UpdateKindofRoom $request, $id)
    {
        $data = $request->all();
        $kindofroom = KindOfRoom::find($id);
        $kindofroom->kindofroom_name = $data['kindofroom_name'];
        $kindofroom->kindofroom_desc = $data['kindofroom_desc'];
        $kindofroom->save();
        return Redirect::to('/admin/kindofroom/index')->with('success','Update kind of room successfully');
    }

    public function delete($id)
    {
        $data = KindOfRoom::find($id);
        $data->delete();
        return Redirect::to('/admin/kindofroom/index')->with('message','Delete kind of room successfully');
    }
    public function unactive_kindofroom($id){
        KindOfRoom::where('id',$id)->update(['kindofroom_status'=>1]);
        return Redirect::to('/admin/kindofroom/index')->with('success','Active kind of room successfully');
    }
    public function active_kindofroom($id){
        KindOfRoom::where('id',$id)->update(['kindofroom_status'=>0]);
        return Redirect::to('/admin/kindofroom/index')->with('message','Unactive kind of room successfully');
    }
    public function show_kindofroom($id){
        $roomType = RoomType::where('roomtype_status','1')->orderBy('id','desc')->get();
        $kindofRoom = KindOfRoom::where('kindofroom_status','1')->orderBy('id','desc')->get();
        $kindofroom_by_id = Room::join('kind_of_rooms','rooms.id','=','kind_of_rooms.id')->where('rooms.id',$id)->get();
        $kindofroom_name =KindOfRoom::where('kind_of_rooms.id',$id)->limit(1)->get();
        return view('booking.showKindofRoom',compact('roomType','kindofRoom','kindofroom_by_id','kindofroom_name'));
    }
}
