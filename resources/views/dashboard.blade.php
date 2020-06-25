@extends('layouts.app')
<!-- nav -->
@section('nav')
<div class="btn-group">
    <button type="button" class="btn  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Boards
    </button>
    <div class="dropdown-menu dropdown-menu-header">
        @foreach ($boards as $board)
        <a href="myboard/{{$board->board_id}}" id="board-{{$board->board_id}}" class="dropdown-item" type="button">{{$board->title}}</a>
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
    <div class="row ">
        @foreach ($boards as $board)
        <div class="col-md-4 mt-5">
            <div class="card">
                <div class="card-header">
                    <strong> {{$board->title}} </strong>
                    @if($board->create_by == Auth::id())
                    <div class="dropdown float-right">
                        <button type="button" class="fa fa-ellipsis-h boardButton" aria-hidden="true" data-toggle="dropdown">
                        </button>
                        <div class="dropdown-menu">
                            <button class="dropdown-item fa fa-pencil-square-o boardButton renameBoard" data-id="{{$board->board_id}}" aria-hidden="true"> Rename</button>
                            <button class="dropdown-item fa fa-minus-circle boardButton deleteBoard" data-id="{{$board->board_id}}" aria-hidden="true"> Delete</button>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <a href="myboard/{{$board->board_id}}" class="btn btn-outline-info btn-sm" aria-hidden="true">Open Board</a>
                    <button class="fa fa-user-plus boardButton float-right invitation" aria-hidden="true" data-id="{{$board->board_id}}"></button>
                </div>
            </div>
        </div>
        @endforeach
        <input type="hidden" id="boardCards">
    </div>
</div>
@endsection
<!-- end body -->
<!-- js -->
@section('js')
@endsection
<!-- end js -->