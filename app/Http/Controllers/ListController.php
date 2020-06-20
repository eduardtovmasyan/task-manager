<?php

namespace App\Http\Controllers;

use App\BoardList;
use Illuminate\Http\Request;
use App\Http\Requests\CreateListRequest;
use App\Http\Resources\BoardList as BoardListResources;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = BoardList::paginate(parent::PER_PAGE);

        return BoardListResources::collection($lists);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateListRequest $request)
    {
        $list = BoardList::create([
            'title' => $request->title,
            'board_id' => $request->board_id,
        ]);

        return BoardListResources::make($list);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $list = BoardList::findOrFail($id);
        
        return BoardListResources::make($list);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateListRequest $request, $id)
    {
        $list = BoardList::findOrFail($id);
        $list->update([
            'title' => $request->title,
            'board_id' => $request->board_id,
        ]);
        
        return BoardListResources::make($list);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BoardList::whereId($id)->delete();
    }
}
