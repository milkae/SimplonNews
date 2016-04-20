<?php

namespace App\Http\Controllers;

use App\User;
use App\Lien;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\LienRepository;

class LienController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request) {
    	$this->validate($request, [
    			'titre' => 'required|max:60',
    			'lien' => 'required|max:100',
    	]);
    	$lien = $request->user()->liens()->create([
        	'titre' => $request->titre,
        	'lien' => $request->lien,
    	]);
        if($request->tags) {
            foreach ($request->tags as $tag) {   
                $lien->tags()->attach($tag);
            }
        }
        $request->user()->increment('karma');
        return redirect('/');
    }

    public function destroy(Request $request, User $user, Lien $lien)
    {
        if (Auth::user()->id === $lien->user->id) {
            $lien->delete();
            $lien->user()->decrement('karma');
		    return redirect('/');
        } else {
            return abort(403);
        }
	}
}
