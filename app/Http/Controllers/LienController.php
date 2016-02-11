<?php

namespace App\Http\Controllers;

use App\Lien;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\LienRepository;

class LienController extends Controller
{
	protected $liens;
	public function __construct()
    {
        $this->middleware('auth');
        $this->liens = Lien::get();
    }

    public function store(Request $request) {
    	$this->validate($request, [
    			'titre' => 'required|max:255',
    			'lien' => 'required|max:255',
    	]);

    	$request->user()->liens()->create([
        	'titre' => $request->titre,
        	'lien' => 'http://' . $request->lien,
    	]);

    	return redirect('/liste');
    }

    public function destroy(Request $request, Lien $lien)
	{
	    $this->authorize('destroy', $lien);
	    $lien->delete();
	    return redirect('/liste');
	}
}
