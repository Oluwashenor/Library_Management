<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    protected $fillable = ['name', 'copies', 'author', 'isbn'];
    use HasFactory;

    public function lends()
    {
        return $this->hasMany(Lend::class);
    }
}
