<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lend;
use Illuminate\Support\Facades\Auth;

class LendController extends Controller
{
    public function create(Request  $request)
    {
        $validatedData = $request->validate([
            'lendee_id' => ['required'],
            'book_id' => ['required'],
        ]);
        $user = Lend::create([
            'lender_id' => Auth::user()->id,
            'lendee_id' => $validatedData['lendee_id'],
            'book_id' => $validatedData['book_id']
        ]);
        toast('Book Created Successfully', 'success');
        return redirect("/books");
    }
}
