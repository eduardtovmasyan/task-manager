<?php

namespace App\Http\Controllers;

use App\Board;
use App\BoardList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyBoardController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$boards = Auth::user()->boards;
        $thisBoard = $boards->where('id', $id)->first();
        $board = Auth::user()->boards()->findOrFail($id);
        $tasks = $board->tasks;

        if (!$thisBoard) {
        	return abort(404);
        }

        return view('myboard')->with('boards',$boards)->with('thisBoard',$thisBoard)->with('tasks',$tasks);
    }
}
