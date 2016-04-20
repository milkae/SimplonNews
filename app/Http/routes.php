<?php
use App\Lien;
use App\User;
use App\Comment;
use App\Tag;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
	Route::auth();

	// Route::get('/', function () {
	//     return view('welcome');
	// });

	Route::get('/home', function () {
	    return view('home');
	});

	Route::get('/profil/{user}', function(User $user){
		$user = User::where('id', $user->id)->first();
		return view('profil.profil', ['user' => $user]);
	});

	Route::get('/', function() {
		$liens = Lien::paginate(10);
		foreach ($liens as $lien) {
			foreach ($lien->likes as $like) {
				if($like->user == Auth::user()){
					$lien->voted = $like->val;
				}
			}
		}
		return view('news.liste', ['news' => $liens]);
	});

	Route::get('liste/users', function() {
		$users = User::get();
		return view('profil.liste', ['users' => $users]);
	});

	Route::get('/comments/{lien}', function(Lien $lien) {
		$comments = Comment::where('lien_id', $lien->id)->where('comment_id', 0)->get();
		return view('news.comments', ['comments' => $comments, 'news' => $lien]);
	});

	Route::get('/poster', function() {
		$tags = Tag::all();
		return view('news.ajout', ['tags' => $tags]);
	});

	Route::get('/profil', 'ProfilController@index');
	Route::get('/edit/profil', 'ProfilController@index');
	Route::post('edit/profil', 'ProfilController@store');

	Route::post('/poster/store', 'LienController@store');
	Route::delete('/poster/{lien}', 'LienController@destroy');

	Route::post('/comment', 'CommentController@store');
	Route::put('/comment/{comment}', 'CommentController@edit');

	Route::get('auth/github', 'Auth\AuthController@redirectToProvider');
	Route::get('auth/github/callback', 'Auth\AuthController@handleProviderCallback');

	Route::post('upLink/{lien}', 'LikeController@upVoteLien');
	Route::post('downLink/{lien}', 'LikeController@downVoteLien');
	Route::post('delLinkVote/{lien}', 'LikeController@delVoteLien');
});