<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProfilController extends Controller
{
    public function getIndex(User $user)
    {
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
		return redirect('profil/' . $request->user()->id);
	}

	public function getList(){
		$users = User::orderBy('name', 'asc')->get();
		return view('profil.liste', ['users' => $users]);
	}

	public function getEdit(Request $request){
		$user = $request->user();
		return view('profil.edit', ['user' => $user]);
	}
}
