<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Result;
use App\Models\Game;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function dashboard(){
       return view('admin.dashboard');
    }
    public function index(){
       $previous_date = Carbon::yesterday()->format('y-m-d'); 
       $current_date = Carbon::now()->format('y-m-d'); 
        $games = Game::with(['previous' => function ($query) use ($previous_date) {
            $query->whereDate('date', $previous_date);
        }, 'current'=> function ($query) use ($current_date) {
            $query->whereDate('date', $current_date);
        },])
        ->has('previous') 
        ->orderBy('result_timing', 'desc')
        ->get();
        return view('website.pages.home', compact('games','current_date' ));
    }
}
