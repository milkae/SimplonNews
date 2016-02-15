<?php

namespace App\Http\Controllers;

use App\User;
use App\Lien;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\LienRepository;

class LienController extends KarmaController
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request) {
    	$this->validate($request, [
    			'titre' => 'required|max:255',
    			'lien' => 'required|max:255',
    	]);

    	$request->user()->liens()->create([
        	'titre' => $request->titre,
        	'lien' => 'http://' . $request->lien,
    	]);
        $this->cheatKarmaAdd($request->user());

    	return redirect('/liste/news');
    }

    public function destroy(Request $request, User $user, Lien $lien)
	{
	    if (Auth::user()->id === $lien->user->id) {
		    $lien->delete();
            $this->cheatKarmaRemove($request->user());
		    return redirect('/liste/news');
        } else {
            return abort(403);
        }
	}
}
