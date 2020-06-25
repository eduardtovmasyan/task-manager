<?php

namespace App\Http\Controllers;

use Mail;
use App\Board;
use App\Mail\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Invitation as InvitationModel;
use App\Http\Requests\InvitationRequest;
use App\Http\Requests\SendInvitationRequest;

class BoardInvitationController extends Controller
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
        $invations = InvitationModel::where('email', Auth::user()->email)->where('status', InvitationModel::STATUS_PENDING)->get();
        
        return view('invites')->with('boards',$boards)->with('invations',$invations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\SendInvitationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store($boardId, SendInvitationRequest $request)
    {
        $sender = Auth::user();
        $board = $sender->boards()->findOrFail($boardId);
        $board->invitations()->create([
            'email' => $request->email,
            'status' => InvitationModel::STATUS_PENDING,
        ]);

        Mail::to($request->email)->send(
            new Invitation($sender->name, $board->title)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  mixed $boardId
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InvitationRequest $request, $id)
    {
        if ($request->status === InvitationModel::STATUS_ACCEPTED) {

            $invite = InvitationModel::findOrFail($id);
            $board = Board::where('id', $invite->board_id)->first();
            $board->users()->attach(Auth::id());
            
            $invite->update([
            'status' => InvitationModel::STATUS_ACCEPTED,
            ]);

        } else if ($request->status === InvitationModel::STATUS_REJECTED) {
            $invite = InvitationModel::findOrFail($id);

            $invite->update([
            'status' => InvitationModel::STATUS_REJECTED,
            ]);
        }
    }
}
