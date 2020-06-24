<?php

namespace App\Http\Controllers;

use App\Board;
use App\BoardList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\Task as TaskResource;

class BoardTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  mixed $boardId
     * @return \Illuminate\Http\Response
     */
    public function index($boardId)
    {
        $board = Auth::user()->boards()->findOrFail($boardId);
        $tasks = $board->tasks;

        return TaskResource::collection($tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  mixed $boardId
     * @param  App\Http\Requests\CreateTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store($boardId, CreateTaskRequest $request)
    {
        $task = Task::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'list_id' => $request->list_id,
            'assigned_to' => $request->assigned_to,
        ]);

        return TaskResource::make($task);
    }

    /**
     * Display the specified resource.
     *
     * @param  mixed $boardId
     * @param  mixed  $taskId
     * @return \Illuminate\Http\Response
     */
    public function show($boardId, $taskId)
    {
        $board = Auth::user()->boards()->findOrFail($boardId);
        $task = $board->tasks()->findOrFail($id);
        
        return TaskResource::make($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  mixed $boardId
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($boardId, UpdateTaskRequest $request, $id)
    {
        $board = Auth::user()->boards()->findOrFail($boardId);
        $task = $board->tasks()->findOrFail($id);
        $task->fill($request->all());
        $task->save();
        
        return TaskResource::make($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($boardId, $taskId)
    {
        //
    }
}
