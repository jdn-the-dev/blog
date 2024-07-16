<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

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
        Sitemap::create()
            ->add(Url::create('/')->setPriority(1.0))
            ->add(Url::create('/home')->setPriority(0.8))
            ->add(Url::create('/resource/my-mind')->setPriority(0.8))
            ->add(Url::create('/blog')->setPriority(0.8))
            ->add(Url::create('/about')->setPriority(0.8))
            ->add(Url::create('/wallpaper')->setPriority(0.8))
            ->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully.');
    }
}
