<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Payment;
use App\Models\Statistics;
use App\Models\User;
use App\Models\Room;
use App\Models\Role;
use App\Models\KindOfRoom;
use App\Models\RoomType;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use PDF;
use Yajra\Datatables\Datatables;
use DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
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
        $visitor_last_month = Visitor::whereBetween('date_visitor', [$early_last_month, $end_of_last_month])->get();
        $visitor_last_month_count = $visitor_last_month->count();

        //total this month
        $visitor_this_month = Visitor::whereBetween('date_visitor', [$early_this_month, $now])->get();
        $visitor_this_month_count = $visitor_this_month->count();

        //total last years
        $visitor_last_year = Visitor::whereBetween('date_visitor', [$old_year, $now])->get();
        $visitor_last_year_count = $visitor_this_month->count();

        //all_visitors
        $all_visitors = Visitor::all();
        $all_visitors_count = $all_visitors->count();
        if ($visitors_count < 1) {
            $visitor = new Visitor();
            $visitor->ip_address = $user_ip_address;
            $visitor->date_visitor = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $visitor->save();
        }

        //Donut
        $room = Room::all()->count();
        $order = Order::all()->count();
        $role_id_user = Role::where('role_name', Role::ROLE_USER)->first()->id;
        $user = User::where('role_id',$role_id_user)->get();
        $user_count = $user->count();
        $role_id_staff = Role::where('role_name', Role::ROLE_STAFF)->first()->id;
        $staff = User::where('role_id',$role_id_staff)->get();
        $staff_count = $staff->count();
        $room_available = Room::where('room_status',1)->get();
        $room_available_count = $room_available->count();
        $room_rented = Room::where('room_status',0)->get();
        $room_rented_count = $room_rented->count();
        $Kind_of_room = KindOfRoom::all()->count();
        $Room_type = RoomType::all()->count();
        return view('admin.dashboard', compact('Kind_of_room','Room_type','room_rented_count','room_available_count','staff_count','visitors_count', 'visitor_last_month_count', 
        'visitor_this_month_count', 'visitor_last_year_count', 'all_visitors_count','room','order','user_count'));
    }
    public function all_order(){
        $all_order = Order::select(
            DB::raw('date_order as day'),
            DB::raw("SUM(order_total) as items_total")
          )
          ->groupBy(DB::raw('date_order'))
          ->get();
        foreach($all_order as $order){
            $data_chart[] = array(
                'order_date' => $order->day,
                'order_total' => $order->items_total,
            );
        }
        echo $data = json_encode($data_chart);
    }
    public function all_room(){
        $all_room = Room::all();
        foreach($all_room as $room){
            $data[] = array(
                'room_name' => $room->room_name,
                'views_room' => $room->count_views,
            );
        }
        echo $room = json_encode($data);
    }

    //filter by date
    public function manager_booking()
    {
        $order = Order::with(['user', 'booking', 'payment'])->first();
        return view('admin.managerBooking.manager');
    }
    public function getDtRowData(Request $request)
    {
        $order = Order::with(['user', 'booking', 'payment'])->get();
        return DataTables::of($order)
            ->editColumn('customer_name', function ($data) {
                return $data->user->name;
            })
            ->editColumn('customer_address', function ($data) {
                return $data->booking->booking_address;
            })
            ->editColumn('order_total', function ($data) {
                return number_format($data->order_total).''.' VND';
            })
            ->editColumn('payment_method', function ($data) {
                if ($data->payment->payment_method == 1) {
                    return 'Pay with cash';
                } else {
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
                },
            ])
            ->make(true);
    }
    public function detail_booking($id)
    {
        $detail_order = Order::find($id);
        return view('admin.managerBooking.detailBooking', compact('detail_order'));
    }
    public function getDtRowDataDetail($id)
    {
        $detail_by_id = Order_detail::with(['order'])->where('order_id', $id)->get();
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
                },
            ])
            ->make(true);
    }
    public function filter_by_day(Request $request)
    {
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $get = Order::whereBetween('date_order', [$from_date, $to_date])->orderBy('date_order', 'ASC')->get();
        foreach ($get as $key => $value) {
            $chat_data[] = array(
                'order_date'  => $value->date_order,
                'order_total' => $value->order_total,
            );
        }
        echo $data = json_encode($chat_data);
    }
    public function dashboard_filter(Request $request)
    {
        $data = $request->all();
        $first_day_of_this_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $early_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $end_of_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub_7_days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $sub_365_days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if ($data['dashboard_value']=='7days') {
            $get = Order::whereBetween('date_order',[$sub_7_days,$now])->orderBy('date_order', 'ASC')->get();
        } elseif ($data['dashboard_value']=='last_month') {
            $get = Order::whereBetween('date_order',[$early_last_month,$end_of_last_month])->orderBy('date_order', 'ASC')->get();
        } elseif ($data['dashboard_value']=='this_month') {
            $get = Order::whereBetween('date_order',[$first_day_of_this_month,$now])->orderBy('date_order', 'ASC')->get();      
        } else {
            $get = Order::whereBetween('date_order',[$sub_365_days,$now])->orderBy('date_order', 'ASC')->get();      
        }
        foreach ($get as $key => $value) {
            $chat_data[] = array(
                'order_date'  => $value->date_order,
                'order_total' => $value->order_total,
            );
        }
        echo $data = json_encode($chat_data);
    }
}
