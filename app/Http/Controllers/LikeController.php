<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function store(Post $post)
    {
        $data = [
            'post_id' => $post->id,
            'user_id' => auth()->user()->id,
        ];

        // $like = Like::where('post_id', $post->id)->first();
        $like = Like::where('post_id', $post->id)->where('user_id', auth()->user()->id)->first();
        // return $user;
        if($like !== null)
        {
           $this->destroy($like);
        }
        else 
        {
            $data['isLiked'] =  true;
            $like = Like::create($data);
        }
        return $like->toJson();
    }

    public function destroy($like)
    {
        $like->delete();

        /**
         * The below code is for update the database isLiked column, 
         * if one wish to update the database row to false instead of deleting 
         */
    /*
         if($like->isLiked == true)
        {
            $data['isLiked'] =  false;
            $like = $like->update($data);
        } 
        else 
        {
            $data['isLiked'] =  true;
            $like = $like->update($data);
        }
        return $like;
    */
    }

    public function countLikes(Post $post)
    {
        $countLikes = Like::where('post_id', $post->id)->get()->count();
        
        return $countLikes;
    }


}
