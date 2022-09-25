<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\CouponRequest;
class CouponController extends Controller
{
    public function index(){
        return view('admin.coupon.index');
    }
    public function save_coupon(CouponRequest $request){
        $data = $request->all();
        $coupon = new Coupon();
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_time = $data['coupon_time'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->save();
        return redirect('/admin/coupon/index')->with('success','Add coupon successfully');
    }
    public function getDtRowData(Request $request)
    {
        $coupon = Coupon::all();
        return DataTables::of($coupon)
            ->editColumn('coupon_name', function ($data) {
                return $data->coupon_name;
            })
            ->editColumn('coupon_time', function ($data) {
                return $data->coupon_time;
            })
            ->editColumn('coupon_condition', function ($data) {
                if($data->coupon_condition == 2)
                {
                    return 'Cash coupon';
                }
                else{
                    return 'Percentage coupon';
                }
            })
            ->editColumn('coupon_number', function ($data) {
                return $data->coupon_number;
            })
            ->editColumn('coupon_code', function ($data) {
                return $data->coupon_code;
            })
            ->editColumn('action', function ($data) {
                return '
                <form method="GET" action="' . route('admin.coupon.delete', $data->id) . '" accept-charset="UTF-8" style="display:inline-block">
                ' . method_field('GET') .
                    '' . csrf_field() .
                    '<button type="submit" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm(\'Do you want to delete this kind of room ?\')"><i class="fa-solid fa-trash" title="Delete Mission"></i>Delete</button>
                </form>
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
    public function deleteCoupon(Request $request)
    {
        
    }
}
