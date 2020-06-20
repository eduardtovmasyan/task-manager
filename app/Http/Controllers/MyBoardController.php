<?php

namespace App\Http\Controllers;

use App\Board;
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
    	$thisBoard = Board::where('boards.id', $id)->distinct()->first();

        $boards = Board::join('users_boards', 'users_boards.board_id', '=', 'boards.id')
            ->where('users_boards.user_id', Auth::id())->distinct()->get();

        return view('myboard')->with('boards',$boards)->with('thisBoard',$thisBoard);
    }
}
