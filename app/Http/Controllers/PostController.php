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
            ->flatMap(fn ($post) => $post->category ?? [])
            ->reduce(function ($carry, $cat) {
                $count = Post::where('category', 'like', '%' . $cat . '%')->count();
                $carry[$cat] = $count;
                return $carry;
            }, []);

        return view('blog', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }
    // Get the latest post
    public function getLatestPost()
    {
        $post = Post::orderBy('created_at', 'desc')->first();
        // If no posts are available, redirect to the blog page with an error message
        if ($post === null) {
            return redirect()->route('blog')->with('error', 'No posts available.');
        }
        return redirect()->route('posts.show', $post);
    }

    //Get post based on ID
    public function getPost(string $post){
        $post = Post::where('slug', $post)->orWhere('id', $post)->first();

        if ($post === null) {
            return redirect()->route('blog')->with('error', 'Post not found.');
        }

        if (request()->route('post') !== $post->slug) {
            return redirect()->route('posts.show', $post, 301);
        }

        if (! auth()->user()) {
            $post->increment('view_count');
        }

        return view('view-blog', ['post' => $post]);
    }

}
