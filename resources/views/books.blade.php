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


<div class="container" style="text-align: center;">My Borrowed Books</div>

<div class="books-div">

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Book</th>
                <th scope="col">Author</th>
                <th scope="col">Date Borrowed</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lends as $lend)
            <tr>
                <th scope="row">{{$lend->id}}</th>
                <td>{{$lend->book->name}}</td>
                <td>{{$lend->book->author}}</td>
                <td>{{$lend->created_at}}</td>
            </tr>
            @endforeach


        </tbody>
    </table>
</div>


@endsection