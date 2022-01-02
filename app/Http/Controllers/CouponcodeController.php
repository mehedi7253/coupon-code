<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\coupon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class CouponcodeController extends Controller
{
    public function index(Request $request){
        $search = $request->get('search');
        $data = DB::table('coupons')
            ->where('coupon_code', '=', $search)
            ->get();
        if (count($data)>0){
           foreach ($data as $d){
               $coupon = $d->coupon_code;
               $discount = $d->discount;
           }
		    $value = Session::get($data, $coupon, $discount);
            return back()->with($value);
            //return view('home',compact('discount','coupin','data'));
        }else{
            $error = 'In Valid Coupon Code';
            return view('home', compact('error','data'));
        }
    }
}
