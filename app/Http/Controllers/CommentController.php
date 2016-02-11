<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Lien;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request) {
    	$this->validate($request, [
    		'comment' => 'required|max:255',
    	]);

    	$request->user->comments()->create([
        	'comment' => $request->comment,
    	]);

    	return redirect($request->lien_id. '/comments');
    }

    public function destroy(Request $request, User $user, Comment $comment)
	{
	    if (Auth::user()->id === $comment->user->id) {
		    $comment->delete();
		    return redirect('/comments');
        } else {
            return abort(403);
        }
	}
}