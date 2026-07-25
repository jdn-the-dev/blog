@php
    $editing = isset($post);
    $categories = $editing ? implode(', ', $post->category ?? []) : '';
@endphp

@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <strong>Please fix the following:</strong>
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card p-3 p-md-4">
            <div class="mb-3">
                <label class="form-label" for="title">Title</label>
                <input class="form-control" id="title" name="title" required maxlength="200"
                       value="{{ old('title', $post->title ?? '') }}">
            </div>
            <div>
                <label class="form-label" for="floatingTextarea">Content</label>
                <quill-editor placeholder="{{ old('blogHTML', $post->blogHTML ?? '') }}"></quill-editor>
                <input type="hidden" name="blogHTML" id="floatingTextarea"
                       value="{{ old('blogHTML', $post->blogHTML ?? '') }}">
                <div class="form-text">Tab inserts spacing at the cursor without moving the entire paragraph. Press Shift+Tab to remove the preceding tab spacing.</div>
            </div>
        </div>
    </div>

    <aside class="col-lg-4">
        <div class="card p-3 p-md-4">
            <h2 class="h5">Publishing</h2>
            <div class="mb-3">
                <label class="form-label" for="date">Publish date</label>
                <input class="form-control" id="date" type="date" name="date"
                       value="{{ old('date', isset($post) ? $post->created_at?->format('Y-m-d') : now()->format('Y-m-d')) }}">
            </div>
            <div class="mb-3">
                <label class="form-label" for="category">Categories</label>
                <input class="form-control" id="category" name="category" required maxlength="500"
                       value="{{ old('category', $categories) }}" placeholder="Laravel, Security, SEO">
                <div class="form-text">Separate reusable categories with commas.</div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="image">Featured image</label>
                @if ($editing && $post->image)
                    <img class="img-fluid rounded mb-2" src="{{ asset('images/'.$post->image) }}" alt="">
                @endif
                <input class="form-control" id="image" type="file" name="image" accept="image/jpeg,image/png,image/gif,image/webp" {{ $editing ? '' : 'required' }}>
            </div>
            <div class="mb-3">
                <label class="form-label" for="image_alt">Image description</label>
                <input class="form-control" id="image_alt" name="image_alt" maxlength="180"
                       value="{{ old('image_alt', $post->image_alt ?? '') }}" placeholder="Describe the image for readers">
            </div>

            <hr>
            <h2 class="h5">Search preview</h2>
            <div class="mb-3">
                <label class="form-label" for="slug">URL slug</label>
                <input class="form-control" id="slug" name="slug" maxlength="200"
                       value="{{ old('slug', $post->slug ?? '') }}" placeholder="generated-from-title">
            </div>
            <div class="mb-3">
                <label class="form-label" for="seo_title">SEO title</label>
                <input class="form-control" id="seo_title" name="seo_title" maxlength="70"
                       value="{{ old('seo_title', $post->seo_title ?? '') }}" placeholder="Defaults to the post title">
            </div>
            <div class="mb-3">
                <label class="form-label" for="meta_description">Meta description</label>
                <textarea class="form-control" id="meta_description" name="meta_description" rows="3" maxlength="160"
                          placeholder="A concise summary for search results">{{ old('meta_description', $post->meta_description ?? '') }}</textarea>
            </div>
            <button class="btn btn-dark w-100" type="submit">{{ $editing ? 'Update post' : 'Publish post' }}</button>
        </div>
    </aside>
</div>
