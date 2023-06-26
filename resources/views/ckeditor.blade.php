<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap 4 Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>


<div class="container">
    <div class="row">
        <div class="col-sm-8 mt-5">
            <form method="POST" action="/ckeditor_func">
                @csrf

                <textarea name="desciption" id="editor" class="editor form-control"></textarea>
                <!-- <div id="editor"></div> -->
                <button class="btn btn-success mt-4" type="submit">Submit</button>

            </form>
        </div>
    </div>
</div>

<!-- <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script> -->
<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/standard/ckeditor.js"></script>

<!-- <script src="{{asset('ckeditor5/build/ckeditor.js')}}"></script> -->
<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/super-build/ckeditor.js"></script>

<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ), {
            toolbar: [
                'heading',
                '|',
                'bold',
                'italic',
                'underline',
                'strikethrough',
                'subscript',
                'superscript',
                '|',
                'fontColor',
                'fontBackgroundColor',
                'highlight',
                '|',
                'alignment',
                'outdent',
                'indent',
                '|',
                'link',
                'bulletedList',
                'numberedList',
                '|',
                'blockQuote',
                'insertTable',
                'mediaEmbed',
                'undo',
                'redo'
                // Add more toolbar items here
            ]
        } )
        .catch( error => {
            console.error( error );
        } );
</script>

</body>
</html>