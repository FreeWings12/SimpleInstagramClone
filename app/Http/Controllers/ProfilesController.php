<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ProfilesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user, $slug) 
    {

        $follows = $this->follows($user);
        $postsCount = $this->countPosts($user);
        $followersCount = $this->countFollowers($user);
        $followingCount = $this->countFollowing($user);
        
        return view('profiles.index', compact('user', 'follows', 'postsCount', 'followersCount', 'followingCount'));
    }


    public function edit(User $user) {
        
        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }

    public function update(User $user) {
        
        $this->authorize('update', $user->profile);
    
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',
        ]);

        if(request('image')) {
            $imagePath = request('image')->store('profile','public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();
            $imageArray = ['image' => $imagePath];
        } 

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? [],
        ));
        
        return redirect()->route('profile.index', ['user' => $user->id, 'slug' => $user->username]);

    }


    private function follows(User $user)
    {
        $follows = auth()->user() ? auth()->user()->following->contains($user->id) : false; 
        return $follows;
    }

    private function countPosts(User $user)
    {
        $postsCount = Cache::remember(
            'count.posts.'.$user->id, 
            now()->addSeconds(10), 
            function() use ($user) {
            return $user->posts->count();
        });

        return $postsCount;
    }

    private function countFollowers(User $user)
    {
        $followersCount = Cache::remember(
            'count.followers.'.$user->id, 
            now()->addSeconds(10), 
            function() use ($user) {
            return $user->profile->followers->count();
        });

        return $followersCount;
    }
    
    private function countFollowing(User $user)
    {
        $followingCount = Cache::remember(
            'count.following.'.$user->id, 
            now()->addSeconds(10), 
            function() use ($user) {
            return $user->following->count();
        });

        return $followingCount;
    } 


    public function myProfile()
    {
        $follows = $this->follows($user);
        $postsCount = $this->countPosts($user);
        $followersCount = $this->countFollowers($user);
        $followingCount = $this->countFollowing($user);
        
        return view('profiles.index', compact('user', 'follows', 'postsCount', 'followersCount', 'followingCount'));

    }
}
