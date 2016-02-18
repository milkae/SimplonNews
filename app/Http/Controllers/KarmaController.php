<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Karma;
use App\Lien;
use Redirect;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class KarmaController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function addKarma(Request $request, Lien $lien) {
    	if(!Karma::where('user_id', $request->user()->id)->where('lien_id', $lien->id)->first()) {
	    	$request->user()->karmas()->create([
	        	'lien_id' => $lien->id,
	        	'plus' => 1,
	    	]);
	    	$lien->user()->increment('karma');
		} else { //Si il a déjà voté sur ce lien, on annule et supprime si c'était un +1, on modifie et ajuste le karma du posteur si c'était un moins
			$req = $request->user()->karmas()->where('lien_id', $lien->id)->first();
			if($req->plus == 1) {
				$lien->user->decrement('karma');
				$req->delete();
			} else {
				$lien->user->increment('karma', 2);
	    		$request->user()->karmas()->where('lien_id', $lien->id)->increment('plus');
	    		$request->user()->karmas()->where('lien_id', $lien->id)->decrement('moins');
			}
		}
		return Redirect::back();   	
    }
    public function removeKarma(Request $request, Lien $lien) {
    	if(!Karma::where('user_id', $request->user()->id)->where('lien_id', $lien->id)->first()) {
	    	$request->user()->karmas()->create([
	        	'lien_id' => $lien->id,
	    	]);
	    	$request->user()->karmas()->where('lien_id', $lien->id)->increment('moins');
	    	$lien->user()->decrement('karma');
		} else {
			$req = $request->user()->karmas()->where('lien_id', $lien->id)->first();
			if($req->moins == 1) {
				$lien->user->increment('karma');
				$req->delete();
			} else {
				$lien->user->decrement('karma', 2);
	    		$request->user()->karmas()->where('lien_id', $lien->id)->decrement('plus');
	    		$request->user()->karmas()->where('lien_id', $lien->id)->increment('moins');
			}
		}
		return Redirect::back();  	
    }
}
