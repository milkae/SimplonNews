<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Lien extends Model
{
    protected $fillable = ['titre', 'lien'];

    public function user() {
    	return $this->belongsTo(User::class);
    }
}
