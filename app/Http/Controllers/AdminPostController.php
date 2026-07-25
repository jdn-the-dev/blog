<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\SurveyResponse;
use App\Models\GiveawayCampaign;
use App\Models\GiveawayEntry;
use App\Services\HtmlSanitizer;
use Illuminate\Validation\Rule;

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
    public function deletePost(Post $post)
    {
        $post->delete();

        return redirect()->route('blog')->with('success', 'Post deleted successfully.');
    }
    //Create Post Screen
    public function createIndex()
    {
        return view('create-post');
    }
    // Store post
    public function store(Request $request, HtmlSanitizer $sanitizer)
    {
        $data = $this->validated($request);
        $post = new Post($this->attributes($data, $sanitizer));
        $post->id = (string) Str::uuid();
        $post->image = $this->storeImage($request);
        $post->save();

        return redirect()->route('posts.show', $post)->with('success', 'Post created successfully.');
    }

    public function editIndex(Post $post)
    {
        return view('edit-post', ['post' => $post]);
    }
    // Edit post based on ID

    public function editPost(Request $request, Post $post, HtmlSanitizer $sanitizer)
    {
        $data = $this->validated($request, $post);
        $post->fill($this->attributes($data, $sanitizer, $post));
        if ($request->hasFile('image')) {
            $post->image = $this->storeImage($request);
        }
        $post->save();

        return redirect()->route('posts.show', $post)->with('success', 'Post updated successfully.');
    }

    private function validated(Request $request, ?Post $post = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'slug' => ['nullable', 'string', 'max:200', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', Rule::unique('posts')->ignore($post?->id)],
            'blogHTML' => ['required', 'string', 'max:2000000'],
            'category' => ['required', 'string', 'max:500'],
            'seo_title' => ['nullable', 'string', 'max:70'],
            'meta_description' => ['nullable', 'string', 'max:160'],
            'image_alt' => ['nullable', 'string', 'max:180'],
            'date' => ['nullable', 'date'],
            'image' => [$post ? 'nullable' : 'required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:4096'],
        ]);
    }

    private function attributes(array $data, HtmlSanitizer $sanitizer, ?Post $post = null): array
    {
        return [
            'title' => trim($data['title']),
            'slug' => $this->uniqueSlug($data['slug'] ?: $data['title'], $post),
            'blogHTML' => $sanitizer->sanitize($data['blogHTML']),
            'category' => collect(explode(',', $data['category']))->map(fn ($value) => trim($value))->filter()->unique()->values()->all(),
            'seo_title' => $data['seo_title'] ?: null,
            'meta_description' => $data['meta_description'] ?: null,
            'image_alt' => $data['image_alt'] ?: null,
            'created_at' => $data['date'] ?? now(),
        ];
    }

    private function uniqueSlug(string $value, ?Post $post = null): string
    {
        $base = Str::slug($value) ?: 'post';
        $slug = $base;
        $suffix = 2;
        while (Post::where('slug', $slug)->when($post, fn ($query) => $query->whereKeyNot($post->getKey()))->exists()) {
            $slug = $base.'-'.$suffix++;
        }

        return $slug;
    }

    private function storeImage(Request $request): string
    {
        $file = $request->file('image');
        $name = Str::uuid().'.'.$file->extension();
        $file->move(public_path('images'), $name);

        return $name;
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
