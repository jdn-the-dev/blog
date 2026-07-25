<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('posts')
            ->select(['id', 'category'])
            ->orderBy('id')
            ->chunk(100, function ($posts) {
                foreach ($posts as $post) {
                    $decoded = is_string($post->category)
                        ? json_decode($post->category, true)
                        : $post->category;

                    if (is_array($decoded)) {
                        $categories = $decoded;
                    } elseif (is_string($decoded)) {
                        $categories = explode(',', $decoded);
                    } else {
                        $categories = explode(',', (string) $post->category);
                    }

                    $categories = collect($categories)
                        ->map(fn ($category) => trim((string) $category))
                        ->filter()
                        ->unique()
                        ->values()
                        ->all();

                    DB::table('posts')->where('id', $post->id)->update([
                        'category' => json_encode($categories, JSON_UNESCAPED_UNICODE),
                    ]);
                }
            });
    }

    public function down(): void
    {
        // Normalized JSON arrays are also valid for earlier application versions.
    }
};
