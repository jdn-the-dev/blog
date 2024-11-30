<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    // Show all posts
    public function index(Request $request)
    {
        $search = $request->query('search');
        $category = $request->query('category');

        $posts = Post::query();

        if ($search) {
            $posts->where('title', 'like', '%' . $search . '%');
        }

        if ($category && $category !== 'all') {
            $posts->where('category', 'like', '%' . $category . '%');
        }

        $posts = $posts->orderBy('created_at', 'desc')->paginate(5);

        // Fetch categories and count posts for each
        $categories = Post::select('category')
            ->distinct()
            ->get()
            ->flatMap(function ($post) {
                return explode(',', $post->category); // Split comma-separated categories
            })
            ->reduce(function ($carry, $cat) use ($posts) {
                $count = Post::where('category', 'like', '%' . $cat . '%')->count();
                $carry[$cat] = $count;
                return $carry;
            }, []);

        return view('blog', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
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
