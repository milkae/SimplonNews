<?php
use App\Lien;
use App\User;
use App\Comment;
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

	Route::get('/', function () {
	    return view('welcome');
	});

	Route::get('/home', function () {
	    return view('home');
	});

	Route::get('/profil/{user}', function(User $user){
		$user = User::where('id', $user->id)->first();
		return view('profil.profil', ['user' => $user]);
	});

	Route::get('/liste/news', function() {
		$liens = Lien::paginate(10);
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
		return view('news.ajout');
	});

	Route::get('/profil', 'ProfilController@index');
	Route::get('/edit/profil', 'ProfilController@edit');
	Route::post('edit/profil', 'ProfilController@store');

	Route::post('/poster/store', 'LienController@store');
	Route::delete('/poster/{lien}', 'LienController@destroy');

	Route::post('/comment', 'CommentController@store');
	Route::post('/comment/comment', 'CommentController@storecomment');
	Route::delete('/comment/{comment}', 'CommentController@destroy');
	Route::delete('/comment/comment/{comment}', 'CommentController@destroycomment');

	Route::get('auth/github', 'Auth\AuthController@redirectToProvider');
	Route::get('auth/github/callback', 'Auth\AuthController@handleProviderCallback');

	Route::post('addKarma/{lien}', 'KarmaController@addKarma');
	Route::post('removeKarma/{lien}', 'KarmaController@removeKarma');
});
