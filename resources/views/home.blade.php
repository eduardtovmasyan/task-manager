@extends('layouts.app')

<!-- css -->
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard.css') }}">
@endsection
<!-- end css -->

<!-- body -->
@section('content')
<div class="container">
    <div class="row justify-content-left">

        <div class="col">
            <div class="card">
                <div class="card-header">To Do</div>

                <div class="card-body">
                   <button class="btn btn-primary btn-block fa fa-plus addCard" aria-hidden="true"> Add Card</button>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-header">Doing</div>

                <div class="card-body">
                   <button class="btn btn-primary btn-block fa fa-plus addCard" aria-hidden="true"> Add Card</button>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-header">Pending Confirmation</div>

                <div class="card-body">
                 <button class="btn btn-primary btn-block fa fa-plus addCard" aria-hidden="true"> Add Card</button>
                </div>
            </div>
        </div>

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
@endsection
<!-- end js -->
