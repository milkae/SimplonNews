<?php

namespace App;

use App\Karma;
use App\User;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Lien extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['titre', 'lien', 'categorie', 'langue'];

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

    public function getVote($user) {
        $like = $this->likes()->where('user_id', $user->id)->first();
        return ($like) ? $like : false;
    }
}
