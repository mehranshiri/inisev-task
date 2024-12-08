<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostSentLog extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'subscriber_id'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }
}
