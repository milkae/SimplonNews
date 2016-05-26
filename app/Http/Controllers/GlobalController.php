<?php

namespace App\Http\Controllers;

use App\User;
use App\Lien;
use App\Tag;
use App\Comment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\LienRepository;

class GlobalController extends Controller
{
    public function getIndex($page = 'all', $order =  null){
		
    	
		if($order == 'd'){
			$liens = Lien::where('created_at', '>=', Carbon::now()->startOfDay());
		} 
		elseif($order == 'w') {
			$liens = Lien::where('created_at', '>', Carbon::now()->startOfWeek());			
		} 
		elseif($order == 'm') {
			$liens = Lien::where('created_at', '>=', Carbon::now()->startOfMonth());			
		}
		else {
			$liens = Lien::whereNotNull('id');
		}
		if($page !== 'all'){
			$liens = $liens->where('categorie', $page)->orderBy('baseScore', 'desc')->get();
		} else {
			$liens = $liens->orderBy('baseScore', 'desc')->get();
		}

		return view('news.liste', ['news' => $liens, 'page' => $page, 'order' => $order]);
    }

    public function getPoster(){
    	$tags = Tag::all();
		return view('news.ajout', ['tags' => $tags]);
    }

    public function getLink(Lien $lien) {
    	$comments = Comment::where('lien_id', $lien->id)->where('comment_id', 0)->get();
		return view('news.comments', ['comments' => $comments, 'news' => $lien]);
	}
}