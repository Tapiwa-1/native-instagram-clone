<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    public function post()
    {
        //one like belongs to a post
        return $this->belongsTo(Post::class);
    }
}
