<?php

namespace App;

use App\User;
use App\Lien;
use Illuminate\Database\Eloquent\Model;

class Karma extends Model
{
    protected $fillable = ['user_id', 'lien_id'];

    public function user() {
    	return $this->belongsTo(User::class);
    }
}
