<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
		$user = User::where('id', $request->user()->id)->first();
		return view('profil.profil', ['user' => $user]);
	}

	public function store(Request $request){
		User::where('id', $request->user()->id)->update([
				'name' => $request->name,
				'nom' => $request->nom,
				'prenom' => $request->prenom,
				'job' => $request->job,
				'employeur' => $request->employeur,
				'github' => $request->github,
			]);
		return redirect('/profil');
	}
}
