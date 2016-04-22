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
		if($order == 'w') {
			$liens = Lien::where('created_at', '>', Carbon::now()->startOfWeek());			
		} 
		if($order == 'm') {
			$liens = Lien::where('created_at', '>=', Carbon::now()->startOfMonth());			
		}
		if($page !== 'all'){
			if(isset($liens)) {
				$liens = $liens->where('categorie', $page);
			} else {
				$liens = Lien::where('categorie', $page);	
			}
		}
		if(!isset($liens)){
			$liens = Lien::whereNotNull('id');
		}

		$sorted = $liens->get()->sortByDesc(function($val, $key){
			return $val->likes->sum('val');
		});

		return view('news.liste', ['news' => $sorted, 'page' => $page, 'order' => $order]);
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