<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Role;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function getIndex()
    {
    	$users = User::all();
    	$roles = Role::all();
		return view('admin.index', ['users' => $users, 'roles' => $roles]);
	}

	public function setRole(User $user, Role $role) {
		$user->roles()->attach($role);
		return back();
	}

	public function removeRole(User $user, Role $role) {
		$user->roles()->detach($role);
		return back();
	}
}