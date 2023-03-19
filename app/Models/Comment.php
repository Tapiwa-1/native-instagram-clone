<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public function post()
    {
        //every comment belongs to a post
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        //every comments belongs to a user
        return $this->belongsTo(User::class);
    }
}
