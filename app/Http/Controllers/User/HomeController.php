<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Result;
use App\Models\Game;
use App\Models\Blog;
use App\Models\Wallet;
use App\Models\RefferalUser;
use App\Models\Betting;
use App\Models\RefferalAmount;
use App\Models\PaymentMethod;
use App\Models\WithdrawRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
     public function dashboard(){
       return view('dashboard');
    }
    public function game($id){
      $check = Game::where('id', $id)->first();
      if($check->status == 1){
        return view('website.game.game', compact('check', 'id'));
      }else{
        return redirect('/');
      }
    }
    public function history(){

       $data = Betting::where('user_id', auth()->user()->id)->with('game')->orderBy('id','DESC')->paginate(10);
       return view('website.game.history', compact('data'));
    }
    public function wallet(){
      $data = Wallet::where('user_id', auth()->user()->id)->orderBy('id','DESC')->paginate(10);
       return view('website.game.wallet', compact('data'));
    }
    public function payment(){
      $data ='';
      // $data = Wallet::where('user_id', auth()->user()->id)->orderBy('id','DESC')->paginate(10);
       return view('website.pages.payment', compact('data'));
    }
    public function withdraw(){
      $data = PaymentMethod::get();
      $withdraw_data = WithdrawRequest::with('method')->where('user_id',auth()->user()->id)->get();
      return view('website.pages.withdraw', compact('data', 'withdraw_data'));
    }
    public function refer_earn(){
      $array = [];
      $data = RefferalUser::with('refferal_amount')->with('receiver')->where('giver_id', auth()->user()->id)->get();
      foreach($data as $d){
        $sum = RefferalAmount::where('ref_id', $d->id)->sum('amount');
        $value = array(
          'name' => $d->receiver->name,
          'email' => $d->receiver->email,
          'sum'=>$sum,
          'date'=> Carbon::parse($d->created_at)->format('d M Y h:i a') 
        );
        array_push($array, $value);
      }

      return view('website.pages.refer_earn', compact('array'));
    }
    public function page($slug){
      $page = Blog::where('slug', $slug)->first();
      if($page){
        return view('website.pages.page', compact('page'));
      }else{
        return redirect('/');
      }
    }
    public function blog($slug){
      $page = Blog::where('slug', $slug)->first();
      if($page){
        if($page->type == 'custom'){
          return view('website.custom.telangana-satta-khabar', compact('page'));
        }else{
          return view('website.pages.page', compact('page'));
        }
      }else{
        return redirect('/');
      }
    }
}