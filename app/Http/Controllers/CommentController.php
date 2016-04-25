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
	    if (Auth::user()->hasRole('admin')) {
            foreach($comment->children as $comment) {
    		    $comment->delete();
                $comment->user()->decrement('karma');
            }
            $comment->delete();
            $comment->user()->decrement('karma');
            return back();
        } else {
            $comment->update(['content' => "Commentaire supprimé par l'utilisateur"]);
            $comment->user()->decrement('karma');
            return back();
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
