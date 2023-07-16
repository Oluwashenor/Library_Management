<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('books', compact('books'));
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
        return redirect("/books");
    }
}
