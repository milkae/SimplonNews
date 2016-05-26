<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
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
    public function getVotePower($user) {
        //add Role et notoriété calc
        return 1;
    }

    public function handleLikes($table, $itemId, $voteType) {
        if($table == 'liens') {
            $item = Lien::where('id', $itemId)->first();
        } elseif ($table = 'comments') {
            $item = Comment::where('id', $itemId)->first() ;     
        }
        $user = Auth::user();
        $votePower = $this->getVotePower($user);
        $hasUpvoted = $user->hasUpvoted($item);
        $hasDownvoted = $user->hasDownvoted($item);

        if (!$item || !$user || $voteType === 'upvote' && $hasUpvoted || $voteType === 'downvote' && $hasDownvoted) {
            return back();
        }

        switch ($voteType) {
            case 'upvote':
                if($hasDownvoted) {
                    $this->handleLikes($table, $itemId, 'deldownvote');
                }
                $l = new Like([
                'user_id' => $user->id,
                'val' => 1
                ]);
                $item->likes()->save($l);
                $item->user()->increment('karma');
                $item->increment('baseScore');
                break;
            case 'downvote':
                if($hasUpvoted) {
                    $this->handleLikes($table, $itemId, 'delupvote');
                }
                $l = new Like([
                'user_id' => $user->id,
                'val' => -1
                ]);
                $item->likes()->save($l);
                $item->user()->decrement('karma');
                $item->decrement('baseScore');
                break;
            case 'delupvote':
                $item->user()->decrement('karma');
                $item->decrement('baseScore');
                $item->getVote($user)->delete();
                break;
            case 'deldownvote':
                $item->user()->increment('karma');
                $item->increment('baseScore');
                $item->getVote($user)->delete();
                break;
        }
        return back();
    }
}
