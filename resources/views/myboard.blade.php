@extends('layouts.app')
<!-- nav -->
@section('nav')
<div class="btn-group">
    <button type="button" class="btn  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Boards
    </button>
    <div class="dropdown-menu dropdown-menu-header">
        @foreach ($boards as $board)
        <a href="http://127.0.0.1:8000/myboard/{{ $board->id }}" class="dropdown-item" type="button">{{ $board->title }}</a>
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
<link rel="stylesheet" type="text/css" href="{{ asset('css/task.css') }}">
@endsection
<!-- end css -->
<!-- body -->
@section('content')
<div id="main" class="pb-3">
    @foreach ($thisBoard->lists as $list)
    <div class="list" data-id="{{ $list->id }}">
        <div class="title removable listName" data-id="{{ $list->id }}">{{ $list->title }} <span class="foat-right listDelete" data-id="{{$list->id}}" >x</span></div>
        <div class="content"></div>
        <div class="add-card editable">Add another card</div>
    </div>
    @endforeach
    <div class="add-list">
        <div class="title editable">Add another list</div>
    </div>
</div>
<input type="hidden" id="current-board-id" value="{{ $thisBoard->id }}">
<div class="modal" id="mytasks"></div>
<div id="current-board-users">
    @foreach ($thisBoard->users as $user)
    <input type="hidden" class="thisBoardUser current-board-user" data-id="{{ $user->name }}" value="{{ $user->id }}">
    @endforeach
</div>
@endsection
<!-- end body -->
<!-- js -->
@section('js')
<script type="text/javascript" src="{{ asset('js/task.js') }}"></script>
@endsection
<!-- end js -->
