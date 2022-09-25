<?php

namespace App\Http\Controllers;
use App\Models\Admin; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Models\Room;
use App\Models\User;
use App\Models\Payment;
use App\Models\Order_detail;
use App\Models\Order;
use Yajra\Datatables\Datatables;
use DB;
use PDF;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view('admin.dashboard');
    } 
   public function manager_booking(){
    return view( 'admin.managerBooking.manager');
   }
   public function getDtRowData(Request $request)
   {
       $order = DB::table('orders')
       ->join('users','orders.user_id','=','users.id')
       ->select('orders.*','users.name')
       ->orderby('orders.id','desc')->get();      
       return DataTables::of($order)
           ->editColumn('name', function ($data) {
            return ' <a href="' . route('admin.managerBooking.detail', $data->id) . '">' . $data->name . '</a>';
           })
           ->editColumn('order_total', function ($data) {
            return $data->order_total;
           })
           ->editColumn('order_status', function ($data) {
               return $data->order_status;
           })
           ->rawColumns(['name'])
           ->setRowAttr([
               'data-row' => function ($data) {
                   return $data->id;
               }
           ])
           ->make(true);
   }
   public function detail_booking($id){
    $detail = Order::where('orders.id',$id)->get();
    // echo '<pre>';
    // print_r($detail);
    // echo '</pre>';
    return view('admin.managerBooking.detailBooking',compact('detail'));
   }
   public function getDtRowDataDetail()
   {   
    $detail_by_id = DB::table('orders')
    ->join('users','orders.user_id','=','users.id')
    ->join('bookings','orders.booking_id','=','bookings.id')
    ->join('order_details','orders.id','=','order_details.order_id')
    ->select('orders.*','users.*','bookings.*','order_details.*')->get(); 
       return DataTables::of($detail_by_id)
           ->editColumn('name', function ($data) {
            return $data->name;
           })
           ->editColumn('booking_address', function ($data) {
            return $data->booking_address;
           })
           ->editColumn('booking_number', function ($data) {
               return $data->booking_number;
           })
           ->editColumn('room_name', function ($data) {
            return $data->room_name;
           })
           ->editColumn('room_sales_quantity', function ($data) {
            return $data->room_sales_quantity;
           })
           ->editColumn('order_total', function ($data) {
            return $data->order_total;
           })

           ->rawColumns(['name'])
           ->setRowAttr([
               'data-row' => function ($data) {
                   return $data->id;
               }
           ])
           ->make(true);
   }
   public function print_order($id){
    $order_details = Order_detail::where('order_id', $id)->get();
    view()->share('order',$order_details);
    $pdf = PDF::loadView('admin.print_order',compact('order_details'));
    return $pdf->stream('order_total');
   }
}