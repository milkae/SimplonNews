<?php

namespace App;

use App\Karma;
use App\Lien;
use App\Comment;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password', 'email', 'employeur', 'job', 'github', 'twitter', 'github_id', 'avatar', 'karma'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function liens() {
        return $this->hasMany(Lien::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function hasRole($roleName)
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->name == $roleName)
            {
                return true;
            }
        }
        return false;
    }

    public function hasUpvoted($item) {
        $like = $item->getVote(Auth::user());
        if ($like && $like->val == 1) {
            return true;
        }
        return false;
    }

    public function hasDownvoted($item) {
        $like = $item->getVote(Auth::user());
        if ($like && $like->val == -1) {
            return true;
        }
        return false;
    }
}
