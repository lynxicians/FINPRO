@extends('layout.layout')

@section('content')
<div class="suggestion">
    <div class="container">
        <div class="pt-5">
            <h2>Create a Suggestion</h2>
            <hr>
        </div>
        <div class="col-lg-8">
            <form method="post" action="/suggestion">
                @csrf
                <div class="mb-3">
                  <label for="title" class="form-label text-uppercase">Title</label>
                  <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="mb-3">
                  <label for="description" class="form-label text-uppercase">Description</label>
                  <input type="text" class="form-control" id="description">
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label text-uppercase">Content</label>
                    <textarea class="form-control" id="editor" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-dark fw-bold">Posting</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('ck-editor')
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection