<?php
use App\Lien;
use App\User;
use App\Comment;
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
Route::get('/liste', function() {
	$liens = Lien::get();
	return view('news.liste', ['news' => $liens]);
});

Route::post('/poster', 'LienController@store');
Route::delete('/poster/{lien}', 'LienController@destroy');
    //
Route::get('{lien}/comments', function(Lien $lien) {
	$comments = Comment::where('lien_id', $lien)->get();
	return view('news.comments', ['comments' => $comments]);
});
Route::post('/comment', 'CommentController@store');
Route::delete('/comment/{comment}', 'CommentController@destroy');
});
