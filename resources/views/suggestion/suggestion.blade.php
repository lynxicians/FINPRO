@extends('layout.layout')

@section('content')
<div class="suggestion">
    <div class="container">
        <div class="pt-5">
            <h2>Create a Suggestion</h2>
            <hr>
        </div>
        <div class="col-lg-8">
            <form method="post" action="{{ route('suggestion-post') }}">
                @csrf
                <div class="mb-3">
                  <label for="title" class="form-label text-uppercase">Title</label>
                  <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="mb-3">
                  <label for="description" class="form-label text-uppercase">Description</label>
                  <input type="text" class="form-control" id="description" name="description">
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label text-uppercase">Content</label>
                    <grammarly-editor-plugin>
                        <textarea class="form-control" id="editor" rows="3" name="content"></textarea>
                    </grammarly-editor-plugin>
                </div>
                <button type="button" id="suggSubmit" class="btn btn-dark fw-bold">Posting</button>
                <button type="submit" id="suggSubmitthepost" class="btn btn-dark fw-bold" hidden>Posting</button>
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
            .then( editor => {
                let suggestionContent = document.querySelector("#editor");
                let buttonSubmit = document.querySelector("#suggSubmit");
                function removeHtmlTags(htmlString) {
                    let cleanString = htmlString.replace(/<\/?[^>]+(>|$)/g, "");
                    return cleanString;
                }
                buttonSubmit.addEventListener("click", function(){
                    const cleanHTML = removeHtmlTags(editor.getData());
                    console.log(cleanHTML);

                    const url = 'https://neutrinoapi-bad-word-filter.p.rapidapi.com/bad-word-filter';
                    const options = {
                    method: 'POST',
                    headers: {
                        'content-type': 'application/x-www-form-urlencoded',
                        'X-RapidAPI-Key': 'f3077bb033msh75fd92b8eb8b6f4p13b3ecjsnbeb1615f7c12',
                        'X-RapidAPI-Host': 'neutrinoapi-bad-word-filter.p.rapidapi.com'
                    },
                    body: new URLSearchParams({
                        content: cleanHTML,
                        'censor-character': '*'
                    }).toString() // Convert the body to a URL-encoded string
                    };

                    async function fetchBadWordFilteredContent() {
                    try {
                        const response = await fetch(url, options);

                        // Check if the response is successful (status code 200-299)
                        if (!response.ok) {
                        throw new Error('Network response was not ok');
                        }

                        const result = await response.json();
                        badWordsString = result["bad-words-list"];
                        console.log(badWordsString.length)
                        console.log(result)

                        if(badWordsString.length > 0)
                        {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'The suggestion you want to create is contain bad words'
                            })
                        }
                        else
                        {
                            const suggSubmitthepost = document.querySelector("#suggSubmitthepost");
                            suggSubmitthepost.click();
                            console.log("submited")
                        }
                    } catch (error) {
                        console.error(error);
                    }
                    }
                    fetchBadWordFilteredContent();
                })
            })
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection