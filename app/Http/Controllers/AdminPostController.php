<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\SurveyResponse;
use App\Models\GiveawayCampaign;
use App\Models\GiveawayEntry;
class AdminPostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //Delete post based on ID
    public function deletePost($id) {
        try {
            $post = Post::find($id);
            if ($post) {
                $post->delete();
            }

        } catch (\Throwable $th) {
            throw $th;
        }
        return redirect()->route('blog')->with('success', 'Post deleted successfully.');

    }
    //Create Post Screen
    public function createIndex()
    {
        return view('create-post');
    }
    // Store post
    public function store(Request $request) {
        // validations
        $request->validate([
        'title' => 'required',
        'blogHTML' => 'required',
        'category' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $post = new Post;
    
        $file_name = time() . '.' . request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $file_name);
    
        $post->id = Str::uuid();
        $post->title = $request->title;
        $post->blogHTML = $request->blogHTML;
        $post->image = $file_name;
        $post->category = $request->category;
        $post->created_at = $request->date;
    
        $post->save();
        return redirect()->route('blog')->with('success', 'Post created successfully.');
    }
    public function editIndex($id)
    {
        $post = Post::find($id);
        return view('edit-post', ['post' => $post]);
    }
    // Edit post based on ID

    public function editPost(Request $request, $id) {
        // validations
        $request->validate([
        'title' => 'required',
        'blogHTML' => 'required',
        ]);
    
        $post = Post::find($id);
    
        $post->title = $request->title;
        $post->blogHTML = $request->blogHTML; 
        $post->category = $request->category;

        if($request->image){
            $file_name = time() . '.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images'), $file_name);

            $post->image = $file_name;
        }
        $post->save();

        return redirect()->route('blog')->with('success', 'Post created successfully.');
    }

    public function adminPostIndex(Request $request)
    {
        $posts = Post::orderBy('created_at', 'desc')->get(); // Sort by creation date in ascending order
        $respondents = SurveyResponse::orderBy('created_at', 'desc')->get();
        $campaign = GiveawayCampaign::current();
        $campaignHistory = GiveawayCampaign::withCount('entries')->latest('id')->get();
        $selectedCampaign = $request->filled('campaign')
            ? $campaignHistory->firstWhere('id', (int) $request->input('campaign'))
            : $campaign;
        abort_unless($selectedCampaign, 404);
        $giveawayEntries = GiveawayEntry::where('campaign_id', $selectedCampaign->id)->latest()->get();
        $giveawayStats = [
            'titan_total' => $campaign->entries()->count(),
            'titan_today' => $campaign->entries()->where('created_at', '>=', now()->startOfDay())->count(),
            'legacy_total' => $respondents->count(),
            'unique_reach' => $giveawayEntries->pluck('email')
                ->merge($respondents->pluck('email'))
                ->map(fn ($email) => strtolower($email))
                ->unique()
                ->count(),
        ];

        return view('admin.posts.index', compact(
            'posts',
            'respondents',
            'campaign',
            'campaignHistory',
            'selectedCampaign',
            'giveawayEntries',
            'giveawayStats'
        ));
    }

}
