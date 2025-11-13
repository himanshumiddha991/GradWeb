<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Result;
use App\Models\Game;
use App\Models\Betting;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class BettingController extends Controller
{
    
    public function index()
    {
        $game = Game::orderBy('result_timing','asc')->get();
        return view('admin.results.results')->with('game', $game);
    }
    public function show($id)
    {
        $game = Game::find($id);
        return view('website.betting.show', compact('game'));
    }
    public function store(Request $request){
       try {
            $inputs = $request->input('inputs');
            $available_fund = auth()->user()->balance(auth()->user()->id);
            $array = [];
            foreach ($inputs as $key => $value) {
                if ($value !== null) {
                    array_push($array, [$key, $value]);
                }
            }

            $total =  array_sum(array_map(function($item) { 
                return $item[1]; 
            }, $array));
            if($total > $available_fund){
                return redirect()->back()->with('error', 'Betting Amount Bigger Than Available Balance');
            }elseif($total == 0){
                return redirect()->back()->with('error', 'Please Select atleast one value');
            }else{
                foreach ($inputs as $key => $value) {
                    if ($value !== null && $value > 0) {
                        $game = new Betting;
                        $game->user_id = auth()->user()->id;
                        $game->game_id = $request->game_id;
                        $game->betting_date = $request->game_date;
                        $game->type = $request->type;
                        $game->status = 'pending';
                        $game->number = $key+1;
                        $game->amount = $value;
                        $game->save();
                        if($game->save()){
                            $wallet =  new Wallet;
                            $wallet->user_id = auth()->user()->id;
                            $wallet->type = 'dr';
                            $wallet->amount = $value;
                            $wallet->betting_id = $game->id; 
                            $wallet->save();  
                        }
                                    
                    }
                }
                return redirect()->back()->with('success', 'Betting Added Successfully!');
            }
       
       } catch (\Throwable $th) {
        return $th;
       }
    }
}