<?php

namespace App;

use App\Lien;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    protected $fillable = ['content', 'lien_id', 'comment_id'];

    public function user() {
    	return $this->belongsTo(User::class);
    }
    
    public function lien() {
    	return $this->belongsTo(Lien::class);
    }

    public function children() {
    	return $this->hasMany('App\Comment', 'comment_id');
    }

    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }

    public function liked(){
        foreach ($this->likes as $like) {
            if($like->user == Auth::user()){
                return $like->val;
            }
        }
        return false;
    }
}
