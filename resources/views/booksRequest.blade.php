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


<!-- Button trigger modal -->
<div class="row" style="max-width: 200px;margin-top:1%;height:50px;margin-left:20px;">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBookModal">
        Make Request
    </button>
</div>


<!-- Modal -->
<div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="/requestBook">
                {{csrf_field()}}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Make a new Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Book Name</label>
                        <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Author</label>
                        <input type="text" name="author" class="form-control" id="exampleFormControlInput1" placeholder="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Book Request</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="books-div">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Book</th>
                <th scope="col">Author</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $request)
            <tr>
                <th scope="row">{{$request->id}}</th>
                <td>{{$request->name}}</td>
                <td>{{$request->author}}</td>
            </tr>
            @endforeach


        </tbody>
    </table>
</div>


@endsection