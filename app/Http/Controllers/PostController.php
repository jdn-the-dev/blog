<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    // Show all posts
    public function index() {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('blog', ['posts' => $posts]);
    }

    //Get post based on ID
    public function getPost($id){
        $post = Post::find($id);

        if(!auth()->user()){
            $post->increment('view_count');
        }
        
     
        return view('view-blog', ['post' => $post]);
    }

}
