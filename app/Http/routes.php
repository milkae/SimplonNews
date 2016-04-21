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
	/* Auth GitHub */
	Route::get('auth/github', 'Auth\AuthController@redirectToProvider');
	Route::get('auth/github/callback', 'Auth\AuthController@handleProviderCallback');

	Route::get('/', 'GlobalController@getIndex');

	Route::get('/poster', 'GlobalController@getPoster')->name('link.form');
	Route::get('/show/{lien}', 'GlobalController@getLink')->name('link.show');

	Route::get('/profil', 'ProfilController@index')->name('own.profile');
	Route::get('/profil/{user}', 'ProfilController@getProfile')->name('user.profile');
	Route::get('liste/users', 'ProfilController@getList')->name('users.list');

	/*Authenticated routes */
	Route::group(['middleware' => 'auth'], function () {
		Route::get('/edit/profil', 'ProfilController@index')->name('own.profile.edit');
		Route::post('edit/profil', 'ProfilController@store')->name('own.profile.edit');

		Route::post('/poster/store', 'LienController@store')->name('link.store');
		Route::delete('/poster/{lien}', 'LienController@destroy')->name('link.del');

		Route::post('/comment', 'CommentController@store')->name('comment.store');
		Route::put('/comment/{comment}', 'CommentController@edit')->name('comment.edit');

		/* Likes */
		Route::post('upLink/{lien}', 'LikeController@upVoteLien')->name('link.vote.up');
		Route::post('downLink/{lien}', 'LikeController@downVoteLien')->name('link.vote.down');
		Route::post('delLinkVote/{lien}', 'LikeController@delVoteLien')->name('link.vote.del');
		Route::post('upComment/{comment}', 'LikeController@upVoteComment')->name('comment.vote.up');
		Route::post('downComment/{comment}', 'LikeController@downVoteComment')->name('comment.vote.down');
		Route::post('delCommentVote/{comment}', 'LikeController@delVoteComment')->name('comment.vote.del');

	});
});