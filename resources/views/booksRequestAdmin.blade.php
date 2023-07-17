<?php
$title = "Book Requests";
?>

@extends('layout')

<style>
    .books-div {
        background-color: white !important;
        padding: 5%;
        max-width: 80%;
        border-radius: 3%;
        margin-left: 13%;
        margin-top: 3%;
    }
</style>



@section('content')


<div class="books-div">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Book</th>
                <th scope="col">Author</th>
                <th scope="col">User</th>
                <!-- <th scope="col">Actions</th> -->
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $request)
            <tr>
                <th scope="row">{{$request->id}}</th>
                <td>{{$request->name}}</td>
                <td>{{$request->author}}</td>
                <td>{{$request->user->name}}</td>
            </tr>
            @endforeach


        </tbody>
    </table>
</div>


@endsection