<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;
use Auth;
use App\Http\Requests;

use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function store(Request $request) {
    	$this->validate($request, [
    		'comment' => 'required|max:255',
    	]);
    	$request->user()->comments()->create([
        	'content' => $request->comment,
        	'lien_id' => $request->news,
            'comment_id' => $request->comment_id,
    	]);
        $request->user()->increment('karma');
    	return back();
    }

    public function destroy(Request $request, Comment $comment)
	{
	    if (Auth::user()->id === $comment->user->id) {
            $id = $comment->lien_id;
		    $comment->delete();
            $request->user()->decrement('karma');
		    return back();
        } else {
            return abort(403);
        }
	}
    public function edit(Request $request, Comment $comment)
    {
       $this->validate($request, [
            'comment' => 'required|max:255',
        ]);
        $comment->update(['content' => $request->comment]);
        return back();
    }
}
