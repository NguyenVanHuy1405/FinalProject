<?php

namespace App\Http\Controllers;
use App\Models\Admin; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Models\Room;
use App\Models\Visitor;
use App\Models\User;
use App\Models\Payment;
use App\Models\Order_detail;
use App\Models\Statistics;
use App\Models\Order;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Carbon;
use DB;
use PDF;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request){
        $user_ip_address = $request->ip();
        $visitors_current = Visitor::where('ip_address', $user_ip_address)->get();
        $visitors_count = $visitors_current->count();

        //calculate date 
        $early_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $end_of_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $early_this_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $old_year = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        //total last month
        $visitor_last_month = Visitor::whereBetween('date_visitor',[$early_last_month,$end_of_last_month])->get();
        $visitor_last_month_count = $visitor_last_month->count();

        //total this month
        $visitor_this_month = Visitor::whereBetween('date_visitor',[$early_this_month,$now])->get();
        $visitor_this_month_count = $visitor_this_month->count();

        //total last years
        $visitor_last_year = Visitor::whereBetween('date_visitor',[$old_year,$now])->get();
        $visitor_last_year_count = $visitor_this_month->count();

        //all_visitors 
        $all_visitors = Visitor::all();
        $all_visitors_count = $all_visitors->count();
        if($visitors_count < 1){
            $visitor = new Visitor();
            $visitor->ip_address = $user_ip_address;
            $visitor->date_visitor = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $visitor->save();
        }
        return view('admin.dashboard',compact('visitors_count','visitor_last_month_count','visitor_this_month_count','visitor_last_year_count','all_visitors_count'));
    } 

    //filter by date
    public function filter_by_day(Request $request){
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $get = Statistics::whereBetween('order_date',[$from_date,$to_date])->orderBy('order_date','ASC')->get();
        foreach($get as $key => $value){
            $chat_data[] = array(
                'period' => $value->order_date,
                'order' => $value->order_total,
                'sales' => $value->sales,
                'profit' => $value->profit,
                'quantity' => $value->quantity
            );
        }
        echo $data = json_encode($chat_data);
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