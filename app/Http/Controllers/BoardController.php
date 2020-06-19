<?php

namespace App\Http\Controllers;

use App\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateBoardRequest;
use App\Http\Resources\Board as BoardResources;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boards = Board::paginate(parent::PER_PAGE);

        return BoardResources::collection($boards);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CreateBoardRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBoardRequest $request)
    {
        $board = Board::create([
            'title' => $request->title,
            'create_by' => Auth::id(),
        ]);

        return BoardResources::make($board);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $board = Board::findOrFail($id);
        
        return BoardResources::make($board);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateBoardRequest $request, $id)
    {
        $board = Board::findOrFail($id);
        $board->update([
            'title' => $request->title,
        ]);
        
        return BoardResources::make($board);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Board::whereId($id)->delete();
    }
}
