<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use App\User;

class FollowsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function store(User $user) {
        return auth()->user()->following()->toggle($user->profile);
    }

    public function showFollowers(User $user)
    {
        $follows = $this->follows($user);
        
        $users = $user->profile->followers->pluck('pivot.user_id');
        $followers = Profile::whereIn('user_id', $users)->with('followers')->get();
        
        return view('Follow.showFollowers', compact('followers', 'user', 'follows'));
    }

    public function showFollowing(User $user)
    {
        $follows = $this->follows($user);

        $following = $user->following;
        return view('Follow.showFollowing', compact('following', 'user', 'follows'));
    }

    private function follows(User $user)
    {
        $follows = auth()->user() ? auth()->user()->following->contains($user->id) : false; 
        return $follows;

    }

}
