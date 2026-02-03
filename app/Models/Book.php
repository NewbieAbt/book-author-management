<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Author;

class Book extends Model
{
    protected $fillable = ['author_id', 'title', 'description'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
