<?php
use App\Lien;
use App\User;
use App\Comment;
use App\Role;
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
	/* Auth GitHub */
	Route::get('auth/github', 'Auth\AuthController@redirectToProvider');
	Route::get('auth/github/callback', 'Auth\AuthController@handleProviderCallback');

	Route::get('/', function(){
		return redirect()->route('index');
	});

	Route::get('/home/{page?}/{order?}', 'GlobalController@getIndex')->name('index');

	Route::get('/poster', 'GlobalController@getPoster')->name('link.form');
	Route::get('/show/{lien}', 'GlobalController@getLink')->name('link.show');

	Route::get('/profil/{user}', 'ProfilController@getIndex')->name('user.profile');
	Route::get('liste/users', 'ProfilController@getList')->name('users.list');

	Route::post('/guestPost', 'GlobalController@storePost');
	/*Authenticated routes */
	Route::group(['middleware' => 'auth'], function () {
		Route::get('/edit/profil', 'ProfilController@getEdit')->name('user.profile.edit');
		Route::post('edit/profil', 'ProfilController@store')->name('user.profile.edit');

		Route::post('/poster/store', 'LienController@store')->name('link.store');
		Route::delete('/poster/{lien}', 'LienController@destroy')->name('link.del');

		Route::post('/comment', 'CommentController@store')->name('comment.store');
		Route::put('/comment/{comment}', 'CommentController@edit')->name('comment.edit');
		Route::delete('/comment/{comment}', 'CommentController@destroy')->name('comment.del');

		/* Likes */
		Route::post('vote/{table}/{itemId}/{voteType}', 'LikeController@handleLikes')->name('handleVote');

		Route::get('/admin', 'AdminController@getIndex')->name('admin.panel')->middleware('role:admin');
		Route::post('/admin/set/role/{user}/{role}', 'AdminController@setRole')->name('set.role')->middleware('role:admin');
		Route::post('/admin/remove/role/{user}/{role}', 'AdminController@removeRole')->name('remove.role')->middleware('role:admin');
	});
});