<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lend extends Model
{

    protected $fillable = ['lender_id', 'lendee_id', 'book_id', 'returned_at'];
    use HasFactory;

    public function lendee()
    {
        return $this->belongsTo(User::class, 'lendee_id');
    }
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
