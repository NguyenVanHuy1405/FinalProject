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
    $order = Order::with(['user','booking','payment'])->first();
    return view( 'admin.managerBooking.manager');
   }
   public function getDtRowData(Request $request)
   {
       $order = Order::with(['user','booking','payment'])->get();      
       return DataTables::of($order)
           ->editColumn('customer_name', function ($data) {
            return $data->user->name;
           })
           ->editColumn('customer_address', function ($data) {
            return $data->booking->booking_address;
           })
           ->editColumn('order_total', function ($data) {
            return $data->order_total;
           }) 
           ->editColumn('payment_method', function ($data) {
            if($data->payment->payment_method == 1){
                return 'Pay with cash';
            }
            else{
                return 'Banking';
            }
        })
        ->editColumn('order_status', function ($data) {
            return $data->booking->booking_number;
        })
        ->editColumn('action', function ($data) {
            return '
            <a class="btn btn-warning btn-sm rounded-pill" href="' . route("admin.managerBooking.detail", $data->id) . '"><i class="fa-solid fa-pen-to-square" title="Edit Room Type"></i>Detail</a>
            ';
        })
           ->rawColumns(['action'])
           ->setRowAttr([
               'data-row' => function ($data) {
                   return $data->id;
               }
           ])
           ->make(true);
   }
   public function detail_booking($id){
    $detail_order = Order::find($id);
    return view('admin.managerBooking.detailBooking',compact('detail_order'));
   }
   public function getDtRowDataDetail($id)
   {   
    $detail_by_id = Order_detail::with(['order'])->where('order_id',$id)->get();
       return DataTables::of($detail_by_id)
           ->editColumn('room_name', function ($data) {
            return $data->room_name;
           })
           ->editColumn('room_sales_quantity', function ($data) {
            return $data->room_sales_quantity;
           })
           ->editColumn('room_price', function ($data) {
            return $data->room_price;
           })
           ->editColumn('order_price', function ($data) {
            return ($data->room_price) * ($data->room_sales_quantity);
           })
           ->editColumn('coupon_booking', function ($data) {
            return $data->order->coupon_booking;
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