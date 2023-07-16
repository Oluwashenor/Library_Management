<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookRequest;
use Illuminate\Support\Facades\Auth;

class BookRequestController extends Controller
{
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'author' => ['string', 'max:255'],
        ]);
        $bookRequest = BookRequest::create([
            'name' => $validatedData['name'],
            'author' => $validatedData['author'],
            'user_id' => Auth::user()->id,
        ]);
        toast('Request Submitted Successfully', 'success');
        return redirect("/booksRequest");
    }

    public function index()
    {

        $requests = BookRequest::all();
        if (auth()->user()->role == 'admin') {
            return view('booksRequestAdmin', compact('requests'));
        } else {
            $requests = BookRequest::where('user_id', Auth::user()->id)->get();
            return view('booksRequest', compact('requests'));
        }
    }
}
