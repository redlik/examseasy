<?php

namespace App\Http\Controllers;
use App\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index() {
        $coupons = Coupon::all();

        return view('dashboard.coupons', compact("coupons"));
    }

    public function enable($id) {
        $coupon = Coupon::find($id);
        if ($coupon->enabled == 1) {
            $coupon->enabled = 0;
        } else {
            $coupon->enabled = 1;
        }
        $coupon->save();

        return redirect('dashboard/coupons'); 
    }

    public function delete($id) {
        Coupon::destroy($id);

        return redirect('dashboard/coupons');
    }


    public function store(Request $request) {
        $coupon = new Coupon($request->all());
        // dd($coupon);
        $coupon->save();

        return redirect('dashboard/coupons'); 
    }
}
