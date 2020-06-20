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
    <div class="row justify-content-left">
@foreach ($boards as $board)
        <div class="col">
            <div class="card">
                <div class="card-header">
                    {{$board->title}}
                <button class="fa fa-minus-circle float-right deleteBoard" data-id="{{$board->board_id}}" aria-hidden="true"></button>
                </div>

                <div class="card-body">
                   <a href="myboard/{{$board->board_id}}" class="btn btn-outline-info btn-sm" aria-hidden="true">Open Board</a>
                   <button class="fa fa-user-plus float-right" aria-hidden="true"></button>
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
