<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Services\HtmlSanitizer;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('title');
            $table->string('seo_title', 70)->nullable()->after('blogHTML');
            $table->string('meta_description', 160)->nullable()->after('seo_title');
            $table->string('image_alt', 180)->nullable()->after('image');
        });

        $sanitizer = app(HtmlSanitizer::class);
        DB::table('posts')->orderBy('created_at')->get()->each(function ($post) use ($sanitizer) {
            $base = Str::slug($post->title) ?: 'post';
            $slug = $base;
            $suffix = 2;
            while (DB::table('posts')->where('slug', $slug)->exists()) {
                $slug = $base.'-'.$suffix++;
            }
            DB::table('posts')->where('id', $post->id)->update([
                'slug' => $slug,
                'blogHTML' => $sanitizer->sanitize($post->blogHTML),
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn(['slug', 'seo_title', 'meta_description', 'image_alt']);
        });
    }
};
