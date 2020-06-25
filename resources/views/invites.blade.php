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
        @foreach ($invations as $invation)
        <div class="col-md-4 mt-5">
            <div class="card">
                <div class="card-header text-center">
                    <strong>{{$invation->board->title}}</strong>
                </div>
                <div class="card-body" data-id="{{$invation->id}}">
                    <button class="btn btn-outline-success invitationButton" aria-hidden="true" data-id="accepted">Accept</button>
                    <button class="btn btn-outline-danger float-right invitationButton" aria-hidden="true" data-id="rejected">Reject</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
<!-- end body -->
<!-- js -->
@section('js')
<script type="text/javascript" src="{{asset('js/invitation.js')}}"></script>
@endsection
<!-- end js -->