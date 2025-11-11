<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WithdrawRequest;
use Illuminate\Support\Carbon;

class PaymentRequest extends Controller
{
    public function show($id){
      $withdraw_data = WithdrawRequest::with('method')->where('user_id',$id)->get();
      return view('admin.payment_request.index', compact('withdraw_data'));
    }
    public function store(Request $request){
        try {
            $withdraw_data = WithdrawRequest::where('id',$request->id)->first();
            $withdraw_data->status = $request->status;
            if($withdraw_data->save()){
              return redirect()->back()->with('success', 'Reqeust Updated successfully!');
            }else{
              return redirect()->back()->with('error', 'Something Went Wrong');
            }
        } catch (\Throwable $th) {
            return $th;
        }
    
    }
}