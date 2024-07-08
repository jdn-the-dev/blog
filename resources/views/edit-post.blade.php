@extends('layouts.app')
@section('content')
<div class="container">
  <h1>Edit</h1>
  <section class="mt-3">
    <form method="post" action="/edit-post/{{$post->id}}" enctype="multipart/form-data">
      @csrf
      <div class="card p-3">
        <label for="floatingInput">Title</label>
        <input class="form-control" type="text" name="title" value="{{$post->title}}">
        <label for="floatingInput">Category</label>
        <input class="form-control" type="text" name="category" value="{{$post->category}}">
        <label for="blogHTML">Content</label>
        <textarea id="content" name="blogHTML" class="tinymce-editor">{{$post->blogHTML}}</textarea>
        <label for="formFile" class="form-label">Add Image</label>
        <img src="" alt="" class="img-blog">
        <input class="form-control" type="file" name="image">
      </div>
      <button class="btn btn-secondary m-3">Save</button>
    </form>
  </section>
  <script>
    tinymce.init({
      selector: 'textarea.tinymce-editor',
      plugins: [
        'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media',
        'searchreplace', 'table', 'visualblocks', 'wordcount', 'checklist', 'mediaembed', 'casechange',
        'export', 'formatpainter', 'pageembed', 'linkchecker', 'a11ychecker', 'tinymcespellchecker',
        'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'mentions',
        'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss',
        'markdown'
      ],
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ],
      ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
    });
</script>
</div>
@endsection