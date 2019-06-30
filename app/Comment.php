<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Post;

class Comment extends Model
{
    //
    protected $fillable = [
        'post_id', 'user_id', 'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function post()
    {
        return $this->belongsTo(Post::class)->withTrashed();
    }
}
