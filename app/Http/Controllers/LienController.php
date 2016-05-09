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
    public function store(Request $request) {
    	$this->validate($request, [
    			'titre' => 'required|max:150',
                'lien' => 'required|url',
    			'categorie' => 'required ',
                'langue' => 'required'
    	]);
    	$lien = $request->user()->liens()->create([
        	'titre' => $request->titre,
        	'lien' => $request->lien,
            'categorie' => $request->categorie,
            'langue' => $request->langue
    	]);
        if($request->tags) {
            foreach ($request->tags as $tag) {   
                $lien->tags()->attach($tag);
            }
        }
        $request->user()->increment('karma');
        return redirect('/');
    }

    public function destroy(Lien $lien)
    {
        if (Auth::user()->id === $lien->user->id || Auth::user()->hasRole('admin')) {
            foreach($lien->comments as $comment){
                foreach($comment->children as $comment) {
                    $comment->delete();
                    $comment->user()->decrement('karma');
                }
                $comment->delete();
                $comment->user()->decrement('karma');
            }
            $lien->delete();
            $lien->user()->decrement('karma');
		    return redirect('/');
        } else {
            return abort(403);
        }
	}
}
