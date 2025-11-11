<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WithdrawRequest;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class PaymentMethodController extends Controller
{
  public function pay_meth_store(Request $request){
    try {
       $available_fund = auth()->user()->balance(auth()->user()->id);
    if($request->amount>$available_fund){
        return redirect()->back()->with('error', 'Requested Amount is bigger Than Available fund');
    }else{
     $w_req =  new WithdrawRequest;
     $w_req->user_id = auth()->user()->id;
     $w_req->method_id = $request->method;
     $w_req->amount = $request->amount;
     $w_req->mobile = $request->mobile_number;
     $w_req->status = "pending";
      if($w_req->save()){
        $wallet =  new Wallet;
        $wallet->user_id = auth()->user()->id;
        $wallet->type = 'dr';
        $wallet->amount = $request->amount;
        $wallet->message = "Wallet Request Added";
        $wallet->save();
          return redirect()->back()->with('success', 'Withdraw Request Successfully Added');
      }else{
          return redirect()->back()->with('error', 'Something Went Wrong');
      }
    }
    } catch (\Throwable $th) {
      return $th;
      return redirect()->back()->with('error', 'Something Went Wrong');
    }
   
  }
}