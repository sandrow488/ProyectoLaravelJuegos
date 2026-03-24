<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = ['title', 'description', 'published', 'url', 'user_id', 'image'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sessions()
    {
        return $this->hasMany(GameSession::class);
    }
}
