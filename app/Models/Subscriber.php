<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'website_id'];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function sentLogs()
    {
        return $this->hasMany(PostSentLog::class);
    }
}
