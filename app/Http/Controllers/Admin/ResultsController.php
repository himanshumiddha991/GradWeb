<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Result;
use App\Models\Betting;
use App\Models\RefferalUser;
use App\Models\Game;
use App\Models\Wallet;
use App\Models\User;
use App\Models\RateList;
use App\Models\RefferalAmount;
use Illuminate\Support\Carbon;

class ResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $game = Game::orderBy('result_timing','asc')->get();
        return view('admin.results.results')->with('game', $game);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function commision_allocate($recv_id, $amount, $bet_id){
        try {
            $get = RefferalUser::where('receiver_id',$recv_id)->first();
            $user = User::where('id', $get->giver_id)->first();
            $amt = $amount*($user->commission/100);
            if($get){
                $wallet = new Wallet;
                $wallet->user_id = $get->giver_id;
                $wallet->type = 'cr';
                $wallet->amount = $amt;
                $wallet->message = 'amount received from Commision';
                $wallet->save();
                $ref_amount =  new RefferalAmount;
                $ref_amount->ref_id = $get->id;
                $ref_amount->amount = $amt;
                $ref_amount->bet_id = $bet_id;
                $ref_amount->save();
            }else{
                return null;
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function store(Request $request)
    {
        $jodi_rate =  RateList::where('type', 'jodi')->first();
        $haruf_rate =  RateList::where('type', 'haruf')->first();
       $find_if_same = Result::where('game_id', $request->id)->whereDate('date',$request->date)->first();
        if(!empty($find_if_same)){
            return redirect()->back()->with('error', 'Result Already Declared');
        }
        $currentDate = Carbon::now();
        $anotherDate = Carbon::parse($request->date);
        if($currentDate< $anotherDate){
            return redirect()->back()->with('error', 'Please Select Current Date');
        }
        $win_lose_status =  Betting::where('game_id', $request->id)->where('betting_date', $request->date)->get();
        if($win_lose_status){
            foreach($win_lose_status as $wls){
                 $status =  Betting::where('id', $wls->id)->first();
                 if($status->type == 'jodi'){
                     if($wls->number == $request->result){
                        $status->status = 'win';
                        $wallet_update =  new Wallet;
                        $wallet_update->user_id = $wls->user_id;
                        $wallet_update->type = 'cr';
                        $wallet_update->amount = $wls->amount*$jodi_rate->rate;
                        $wallet_update->betting_id = $wls->id;
                        $wallet_update->save();
                    }else{
                        $lose = $wls->amount;
                        $this->commision_allocate($wls->user_id, $lose, $wls->id);
                        $status->status = 'lose'; 
                    }
                 }else{
                    $last_digit =  substr($request->result, -1); 
                    if($wls->number == $last_digit){
                        $status->status = 'win';
                        $wallet_update =  new Wallet;
                        $wallet_update->user_id = $wls->user_id;
                        $wallet_update->type = 'cr';
                        $wallet_update->amount = $wls->amount*$haruf_rate->rate;
                        $wallet_update->betting_id = $wls->id;
                        $wallet_update->save();
                    }else{
                        $lose = $wls->amount;
                        $this->commision_allocate($wls->user_id, $lose , $wls->id);
                        $status->status = 'lose';
                    }
                 }
                $status->save();
            }
            // return $win_lose_status;
        }
        // die();
        $game = Game::where('id',$request->id)->first();
        $store = new Result;
        $store->game_id = $request->id;
        $store->date = $request->date;
        $store->number = $request->result;
        if($store->save()){
          return redirect()->back()->with('success', 'Result created successfully!');
        }else{
          return redirect()->back()->with('error', 'Something Went Wrong');
        }
        
        
 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $game = Game::find($id);
        $result = Result::where("game_id", $id)->get();
        return view('admin.results.show', compact('game', 'result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $current_date = Carbon::now()->format('y-m-d');  
       $find_if_same = Result::where('game_id', $request->id)->whereDate('created_at',$current_date)->first();
        $currentTime = Carbon::now()->format('H:i');
        $game = Game::where('id',$request->id)->first();
        $current_time = Carbon::parse($currentTime);
        $result_time = Carbon::parse($game->result_timing);
        if($current_time > $result_time){
            $store = Result::where('id', $request->id)->first();
            $store->game_id = $request->id;
            $store->number = $request->result;
            if($store->save()){
              return redirect()->back()->with('success', 'Result updated successfully!');
            }else{
              return redirect()->back()->with('error', 'Something Went Wrong');
            }
        }else{
            return redirect()->back()->with('error', 'Result time of game is '.$result_time->format('h:i A'). ' please wait');
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $find = Result::find($id);
        if(!empty($find)){
            $find->delete();
           return redirect()->back()->with('success', 'Result Deleted successfully!');
        }else{
            return redirect()->back()->with('error', 'Something Went Wrong');
        }

    }
}
