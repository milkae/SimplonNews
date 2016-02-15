<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Lien;
use App\Comment;
use Auth;

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
    	$request->user()->comments()->create([
        	'content' => $request->comment,
        	'lien_id' => $request->news,
    	]);

        $request->user()->increment('karma');

    	return redirect('comments/' . $request->news);
    }

    public function destroy(Request $request, Comment $comment)
	{
	    if (Auth::user()->id === $comment->user->id) {
            $id = $comment->lien_id;
		    $comment->delete();
            $request->user()->decrement('karma');
		    return redirect('comments/' . $id);
        } else {
            return abort(403);
        }
	}
}
