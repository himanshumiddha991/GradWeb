<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Game;
use Illuminate\Support\Carbon;

class CronController extends Controller
{
    private function game_active($id, $status,$type){
        try {
            $current_date =  Carbon::now()->format('y-m-d'); 
            $next_date =  Carbon::now()->addDay()->format('y-m-d'); 
            $game = Game::where('id', $id)->first();
            $game->status = $status;
            $game->date = $type=='after'?$next_date:$current_date;
            $game->save();
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function game_status_update(){
        try {
            $current_time_stamp = Carbon::now()->toTimeString();
            // $current_time_stamp = '01:00:00';
            $current_hour =  Carbon::now()->format('H:i:s'); 
          
            $all = Game::get();
            $array = [];
            foreach($all as $a){
                if($a->time_type == 'after'){
                    // array_push($array, [$current_time_stamp, $a]);
                    if($current_time_stamp >'07:30:00' || $current_time_stamp< $a->end_time ){
                        
                         $this->game_active($a->id, '1', $a->time_type);
                    }else{
                        $this->game_active($a->id, '0', $a->time_type);
                    }
                }else{
                     if($current_time_stamp >'05:00:00' && $current_time_stamp< $a->end_time ){
                        
                         $this->game_active($a->id, '1', $a->time_type);
                    }else{
                        $this->game_active($a->id, '0', $a->time_type);
                    }
                }     
            }
            return [$array];
        } catch (\Throwable $th) {
            return $th;
        }
    }
}