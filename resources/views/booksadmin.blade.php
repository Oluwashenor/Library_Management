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
<div class="row"
    style="display:flex;justify-content:space-between;margin-top:1%;height:50px;margin-left:20px;width:95%;">
    <button style="width: 150px;" type="button" class="btn btn-primary" data-bs-toggle="modal"
        data-bs-target="#addBookModal">
        Add Books
    </button>
    <button style="width: 150px;" type="button" class="btn btn-outline-info" data-bs-toggle="modal"
        data-bs-target="#lendBookModal">
        Lend Books
    </button>
</div>

<!-- Modal -->
<div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="/createBook">
                {{csrf_field()}}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add a new Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
                            placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Author</label>
                        <input type="text" name="author" class="form-control" id="exampleFormControlInput1"
                            placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">ISBN</label>
                        <input type="text" name="isbn" class="form-control" id="exampleFormControlInput1"
                            placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Copies</label>
                        <input type="number" name="copies" class="form-control" id="exampleFormControlInput1"
                            placeholder="">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
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
                <th scope="col">ISBN</th>
                <th scope="col">Total Copies</th>
                <th scope="col">Copies Out</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <th scope="row">{{$book->id}}</th>
                <td>{{$book->name}}</td>
                <td>{{$book->author}}</td>
                <td>{{$book->isbn}}</td>
                <td>{{$book->copies}}</td>
                <td>{{$book->lends->count()}}</td>
                <td>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#editBookModal{{$book->id}}"
                        class="btn btn-outline-info">Edit</button>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#deleteBookModal{{$book->id}}"
                        class="btn btn-outline-danger">Delete</button>
                    <div class="modal fade" id="deleteBookModal{{$book->id}}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="/deleteBook/{{$book->id}}">
                                    {{csrf_field()}}
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete {{$book->name}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" name="id" value="{{$book->id}}" hidden id="">
                                        Are you sure you want to delete this book
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Proceed to Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="editBookModal{{$book->id}}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="/editBook">
                                    {{csrf_field()}}
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit {{$book->name}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <input type="text" name="id" value="{{$book->id}}" hidden
                                                class="form-control" id="exampleFormControlInput1" placeholder="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Name</label>
                                            <input type="text" name="name" value="{{$book->name}}" class="form-control"
                                                id="exampleFormControlInput1" placeholder="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Author</label>
                                            <input type="text" name="author" value="{{$book->author}}"
                                                class="form-control" id="exampleFormControlInput1" placeholder="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">ISBN</label>
                                            <input type="text" name="isbn" value="{{$book->isbn}}" class="form-control"
                                                id="exampleFormControlInput1" placeholder="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Copies</label>
                                            <input type="number" name="copies" value="{{$book->copies}}"
                                                class="form-control" id="exampleFormControlInput1" placeholder="">
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach


        </tbody>
    </table>
</div>


<!-- Modal -->
<div class="modal fade" id="lendBookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="/lendBook">
                {{csrf_field()}}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lend out Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Borrower</label>
                        <select required name="lendee_id" class="form-select form-select"
                            aria-label=".form-select example">
                            <option selected disabled>Select User</option>
                            @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Book</label>
                        <select required name="book_id" class="form-select form-select"
                            aria-label=".form-select example">
                            <option selected disabled>Select Book</option>
                            @foreach($books as $book)
                            <option value="{{$book->id}}">{{$book->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Lend Out</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection