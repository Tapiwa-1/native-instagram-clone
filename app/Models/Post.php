<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public function user()
    {
        //one post has one user
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        //one post has many comments
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }

    public function likes()
    {
        //one post has many likes
        return $this->hasMany(Like::class);
    }
}
