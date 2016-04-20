<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Like;
use App\User;
use App\Lien;
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
		$l = new Like([
			'user_id' => $request->user()->id,
			'val' => 1
			]);
		$lien->likes()->save($l);
		$lien->user()->increment('karma');
		return back();
    }

    public function downVoteLien(Request $request, Lien $lien) {
		$l = new Like([
			'user_id' => $request->user()->id,
			'val' => -1
			]);
		$lien->likes()->save($l);
		$lien->user()->decrement('karma');
		return back();
    }
    public function delVoteLien(Request $request, Lien $lien) {
    	$this->delVote($request->user(), $lien);
    	return back();
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
