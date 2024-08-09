<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\ViewTracking;

class PostController extends Controller
{
    // Show all posts
    public function index() {
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        return view('blog', ['posts' => $posts]);
    }

    //Get post based on ID
    public function getPost($id){
        $post = Post::find($id);

        $this->trackPostView($post, $id);
     
        return view('view-blog', ['post' => $post]);
    }
    private function trackPostView($post, $id)
    {
        $ip = request()->ip();

        // Check if the IP has already been logged for this blog post
        $existingEntry = ViewTracking::where('blog_post_id', $id)
            ->where('ip_address', $ip)
            ->first();

        if (!$existingEntry) {
            // Log the IP address using the model
            ViewTracking::create([
                'blog_post_id' => $id,
                'ip_address' => $ip,
            ]);

            // Update the views column
            $post->increment('view_count');
        }
    }

}
