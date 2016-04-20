<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Like;
use App\User;
use App\Lien;
use App\Comment;
use Redirect;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LikeController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    public function upVoteLien(Request $request, Lien $lien) {
		$this->upVote($request->user(), $lien);
		return back();
    }

    public function downVoteLien(Request $request, Lien $lien) {
		$this->downVote($request->user(), $lien);
		return back();
    }
    public function delVoteLien(Request $request, Lien $lien) {
    	$this->delVote($request->user(), $lien);
    	return back();
    }

    public function upVoteComment(Request $request, Comment $comment) {
		$this->upVote($request->user(), $comment);
		return back();
    }

    public function downVoteComment(Request $request, Comment $comment) {
		$this->downVote($request->user(), $comment);
		return back();
    }
    public function delVoteComment(Request $request, Comment $comment) {
    	$this->delVote($request->user(), $comment);
    	return back();
    }

    public function upVote($user, $lienOrComment) {
		$l = new Like([
			'user_id' => $user->id,
			'val' => 1
			]);
		$lienOrComment->likes()->save($l);
		$lienOrComment->user()->increment('karma');
    }

    public function downVote($user, $lienOrComment) {
		$l = new Like([
			'user_id' => $user->id,
			'val' => -1
			]);
		$lienOrComment->likes()->save($l);
		$lienOrComment->user()->decrement('karma');
    }

    public function delVote($user, $lienOrComment) {
    	foreach ($lienOrComment->likes as $like) {
    		if($like->user == $user) {
    			if($like->val == 1){
    				$lienOrComment->user()->decrement('karma');
    			} elseif($like->val == -1){
    				$lienOrComment->user()->increment('karma');			
    			}
    			$like->delete();
    		}
    	}
    }
}
