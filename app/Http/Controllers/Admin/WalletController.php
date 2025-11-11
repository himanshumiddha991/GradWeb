<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;

class WalletController extends Controller
{
    public function index(Request $request)
    {
        $user = User::orderBy('id','asc');
        if($request->name){
            $user = $user->where('name','LIKE', '%'.$request->name.'%');
        }
        if($request->email){
            $user = $user->where('name','LIKE', '%'.$request->email.'%');
        }
        $user = $user->get();
        return view('admin.wallet.index', compact('user','request' ));
    }
    public function create()
    {
        
    }
    public function store(Request $request)
    {
       try {
         $wallet = new Wallet;
         $wallet->user_id = $request->id;
         if(empty($request->status)  ){
            return redirect()->back()->with('error', 'Please Select Status');
         }
         $wallet->type = $request->status;
         $wallet->amount = $request->amount;
         if($wallet->save()){
            return redirect()->back()->with('success', 'Result updated successfully!');
         }else{
            return redirect()->back()->with('error', 'Something Went Wrong');
         }
         
         
       } catch (\Throwable $th) {
         return $th;
       }
    }
    public function show($id)
    {
        $credit= Wallet::where('type', 'cr')->where('user_id', $id)->sum("amount");
        $debit= Wallet::where('type', 'dr')->where('user_id', $id)->sum("amount");
       $balance =  $credit-$debit;
     
        $wallet = Wallet::where('user_id', $id)->orderBy('id', 'DESC')->paginate(4);
        return view('admin.wallet.show', compact('wallet', 'id', 'balance'));
    }
    public function edit($id)
    {
        return $id;
    }
    public function update(Request $request, $id)
    {

    }
}
