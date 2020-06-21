@extends('layouts.app')
<!-- nav -->
@section('nav')
<div class="btn-group">
    <button type="button" class="btn  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Boards
    </button>
    <div class="dropdown-menu dropdown-menu-header">
        @foreach ($boards as $board)
        <a href="myboard/{{$board->board_id}}" class="dropdown-item" type="button">{{$board->title}}</a>
        @endforeach
        <hr id="boardHr">
        <button class="dropdown-item fa fa-plus" type="button" data-toggle="modal" data-target="#addBoard"> Add Board</button>
    </div>
</div>
@endsection
<!-- end nav -->
<!-- css -->
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard.css') }}">
@endsection
<!-- end css -->
<!-- body -->
@section('content')
<div class="container">
    <input type="hidden" class="boardId" value="{{$thisBoard->id}}">
    <div class="row justify-content-left">
        @foreach ($thisBoard->lists as $list)
        <div class="col">
            <div class="card">
                <div class="card-header">{{$list->title}}</div>
                <div class="card-body" data-id="{{$list->id}}">
                    <button class="btn btn-primary btn-block fa fa-plus addTask" aria-hidden="true"> Add Task</button>
                </div>
            </div>
        </div>
        @endforeach

<!--  -->
<div id="boardUsers">
        @foreach ($thisBoard->users as $user)
        <input type="hidden" class="thisBoardUser " data-id="{{$user->name}}" value="{{$user->id}}">
        @endforeach
</div>
<!--  -->

        <div class="col">
            <div class="card">
                <div class="card-header fa fa-plus addListName" aria-hidden="true"> Add New List</div>
                <div class="card-body" style="display: none;">
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- end body -->
<!-- js -->
@section('js')
<script type="text/javascript" src="{{asset('js/dashboard.js')}}"></script>
@endsection
<!-- end js -->