<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Observers\PostObserver;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $table = 'posts';

    // As a best practice, always set up the fillable property on your model!
    protected $fillable = [
        'title', 'slug', 'blogHTML', 'seo_title', 'meta_description',
        'image', 'image_alt', 'category', 'created_at',
    ];
    public $incrementing = false;

    public function getCategoryAttribute(mixed $value): array
    {
        if (blank($value)) {
            return [];
        }

        $decoded = is_string($value) ? json_decode($value, true) : $value;
        if (is_array($decoded)) {
            $categories = $decoded;
        } elseif (is_string($decoded)) {
            $categories = explode(',', $decoded);
        } else {
            $categories = explode(',', (string) $value);
        }

        return collect($categories)
            ->map(fn ($category) => trim((string) $category))
            ->filter()
            ->unique()
            ->values()
            ->all();
    }

    public function setCategoryAttribute(mixed $value): void
    {
        $categories = is_array($value) ? $value : explode(',', (string) $value);

        $this->attributes['category'] = json_encode(
            collect($categories)
                ->map(fn ($category) => trim((string) $category))
                ->filter()
                ->unique()
                ->values()
                ->all(),
            JSON_UNESCAPED_UNICODE
        );
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getExcerptAttribute(): string
    {
        return $this->meta_description
            ?: Str::limit(preg_replace('/\s+/', ' ', strip_tags($this->blogHTML)), 160, '');
    }

    public function getSeoTitleAttribute(?string $value): string
    {
        return $value ?: $this->title;
    }
}
