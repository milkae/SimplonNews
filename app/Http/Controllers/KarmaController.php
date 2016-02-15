<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Karma;
use App\Lien;
use App\User;
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
    	if(!Karma::where('user_id', $request->user()->id)->first()) {
	    	$request->user()->karmas()->create([
	        	'lien_id' => $lien->id,
	    	]);
	    	$request->user()->karmas()->increment('plus');
			$this->cheatKarmaAdd($lien->user);
		} else {
			$req = $request->user()->karmas()->where('lien_id', $lien->id)->first();
			if($req->plus == 1) {
				$user->decrement('karma');
				$req->delete();
			} else {
				$user->increment('karma');
	    		$request->user()->karmas()->increment('plus');
	    		$request->user()->karmas()->decrement('moins');
			}
		}
		return redirect('/liste');   	
    }
    public function removeKarma(Request $request, Lien $lien) {
    	if(!Karma::where('user_id', $request->user()->id)->first()) {
	    	$request->user()->karmas()->create([
	        	'lien_id' => $lien->id,
	    	]);
	    	$request->user()->karmas()->increment('moins');
			$this->cheatKarmaRemove($lien->user);
		} else {
			$req = $request->user()->karmas()->where('lien_id', $lien->id)->first();
			if($req->moins == 1) {
				$user->increment('karma');
				$req->delete();
			} else {
				$user->decrement('karma');
	    		$request->user()->karmas()->decrement('plus');
	    		$request->user()->karmas()->increment('moins');
			}
		}
		return redirect('/liste');  	
    }
