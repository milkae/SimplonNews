<?php

namespace App;

use App\Karma;
use App\User;
use App\Comment;
use Illuminate\Database\Eloquent\Model;

class Lien extends Model
{
    protected $fillable = ['titre', 'lien'];

    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
