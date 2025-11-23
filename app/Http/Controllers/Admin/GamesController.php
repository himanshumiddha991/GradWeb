<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Game;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        try {

            // Validate request
            $request->validate([
                'name'          => 'required|string',
                'result_timing' => 'required',
                'start_time'    => 'nullable',
                'end_time'      => 'nullable',
            ]);
            $timeAmountJson = [];

            if (!empty($request->time) && !empty($request->amount)) {
                foreach ($request->time as $index => $t) {
                    if (!empty($t) && isset($request->amount[$index])) {
                        $timeAmountJson[$t] = $request->amount[$index];
                    }
                }
            }
            if (!empty($errors)) {
                return redirect()->back()->with('error', $errors[0]);
            }
            
            // Find record
            $game = Game::findOrFail($id);

            // Update fields
            $game->name          = $request->name;
            $game->result_timing = $request->result_timing;
            $game->start_time    = $request->start_time;
            $game->end_time      = $request->end_time;
            $game->time_amount = json_encode($timeAmountJson);

            if($game->save()){
                return redirect()->back()->with('success', 'Game updated successfully!'); 
            }else{
                return redirect()->back()->with('error', 'Something Went Wrong'); 
            }

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: '.$e->getMessage());
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
        //
    }
}
