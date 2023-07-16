<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Lend;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index()
    {

        if (auth()->user()->role == 'admin') {
            $books = Book::all();
            $users = User::where('role', '!=', 'admin')->get();
            return view('booksadmin', compact('books', 'users'));
        } else {
            $lends = Lend::where('lendee_id', Auth::user()->id)->get();
            return view('books', compact('lends'));
        }
    }

    public function create(Request  $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'isbn' => ['required', 'string', 'max:11', 'unique:books'],
            'copies' => ['required'],
        ]);
        $user = Book::create([
            'name' => $validatedData['name'],
            'author' => $validatedData['author'],
            'isbn' => $validatedData['isbn'],
            'copies' => $validatedData['copies']
        ]);
        toast('Book Created Successfully', 'success');
        return redirect("/books");
    }
}
