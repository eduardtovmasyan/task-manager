<?php

namespace App\Http\Controllers;

use App\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boards = Board::join('users_boards', 'users_boards.board_id', '=', 'boards.id')
            ->where('users_boards.user_id', Auth::id())->distinct()->get();

        return view('dashboard')->with('boards',$boards);
    }
}
