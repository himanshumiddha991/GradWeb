<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Result;
use App\Models\Game;
use Illuminate\Support\Carbon;

class GamesController extends Controller
{
    public function index()
    {
        $game = Game::orderBy('result_timing','asc')->get();
        return view('admin.results.results')->with('game', $game);
    }
    public function create()
    {
    
    }
    public function store(Request $request)
    {
    
 
    }
    public function show($id)
    {
        echo $id;
        // $game = Game::find($id);
        // $result = Result::where("game_id", $id)->get();
        // return view('admin.results.show', compact('game', 'result'));
    }


    public function edit($id)
    {
       
    }


    public function update(Request $request, $id)
    {
      
    }


    public function destroy($id)
    {
     

    }
}
