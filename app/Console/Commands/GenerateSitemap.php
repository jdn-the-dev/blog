<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Post;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the sitemap for the website';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/')->setPriority(1.0))
            ->add(Url::create('/home')->setPriority(0.8))
            ->add(Url::create('/resource/my-mind')->setPriority(0.8))
            ->add(Url::create('/my-mind')->setPriority(0.8))
            ->add(Url::create('/blog')->setPriority(0.8))
            ->add(Url::create('/about')->setPriority(0.8))
            ->add(Url::create('/resource/wallpaper')->setPriority(0.8));

        // Loop through all blog posts and add them to the sitemap
        $blogPosts = Post::all();

        foreach ($blogPosts as $post) {
            $sitemap->add(Url::create("/blog/{$post->id}")->setPriority(0.8));
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully.');
    }
}
