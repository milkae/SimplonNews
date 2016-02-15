<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Lien;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommentController extends KarmaController
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request) {
    	$this->validate($request, [
    		'comment' => 'required|max:255',
    	]);
    	$request->user()->comments()->create([
        	'content' => $request->comment,
        	'lien_id' => $request->news,
    	]);

        $this->cheatKarmaAdd($request->user());

    	return redirect('comments/' . $request->news);
    }

    public function destroy(Request $request, User $user, Comment $comment)
	{
	    if (Auth::user()->id === $comment->user->id) {
		    $comment->delete();
            $this->cheatKarmaRemove($request->user());
		    return redirect('comments/' . $request->news);
        } else {
            return abort(403);
        }
	}
}
