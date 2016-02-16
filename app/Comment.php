<?php

namespace App;

use App\Lien;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
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
}
