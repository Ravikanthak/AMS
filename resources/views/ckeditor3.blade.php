<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CK3</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>





<div id="container">
    <form method="POST" action="/ckeditor_func">
        @csrf
        <textarea name="desciption" id="editor" class="editor form-control"></textarea><br>
        <button class="btn btn-success mt-4" type="submit">Submit Letter</button>

        <button class="view_btn btn btn-success mt-4" type="button">View Submitted Letter</button>    

        <button class="edit_btn btn btn-success mt-4" type="button">Edit Submitted Letter</button>   

        <button class="voice_en btn btn-success mt-4" id="voiceButtonEn" type="button">Voice to Text En</button>

        <button class="voice_si btn btn-success mt-4" id="voiceButtonSi" type="button">Voice to Text Si</button>
    </form>



    <div id="view_form"></div>

</div>


<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/super-build/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webkitSpeechRecognition/1.1.0/webkitSpeechRecognition.js"></script>

<script>

    $(document).ready(function() {

        $("body").on("click",".view_btn",function(){
            $.ajax({
                url:"{{ url('') }}/ckeditor_view_func",
                method:'POST',
                dataType:'json',
                data:{ "_token": "{{ csrf_token() }}" },
                success: function(response) {
                    $('#view_form').html(response.data.text);
                }
            });
        });  

        $("body").on("click",".edit_btn",function(){
            $.ajax({
                url:"{{ url('') }}/ckeditor_edit_func",
                method:'POST',
                dataType:'json',
                data:{ "_token": "{{ csrf_token() }}" },
                success: function(response) {
                    ckEditor.setData(response.data.text);
                }
            });
        });  


    });



    const voiceButtonEn = document.getElementById('voiceButtonEn');
    const voiceButtonSi = document.getElementById('voiceButtonSi');

    const editorElement = document.getElementById('editor');

    let ckEditor;
    
    CKEDITOR.ClassicEditor.create( editorElement, {

        toolbar: {
            items: [
                'heading', '|',
                'bold', 'italic', 'strikethrough', 'underline', 'subscript', 'superscript', 'removeFormat', '|',
                'bulletedList', 'numberedList', 'todoList', '|',
                'outdent', 'indent', '|',
                'undo', 'redo',
                '-',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                'alignment', '|',
                'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', '|',
                'specialCharacters', 'horizontalLine', '|'
            ],
            shouldNotGroupWhenFull: true
        },
        list: {
            properties: {
                styles: true,
                startIndex: true,
                reversed: true
            }
        },
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
            ]
        },
        placeholder: 'Welcome to Dailymail v3',
        fontFamily: {
            options: [
                'default',
                'Arial, Helvetica, sans-serif',
                'Courier New, Courier, monospace',
                'Georgia, serif',
                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                'Tahoma, Geneva, sans-serif',
                'Times New Roman, Times, serif',
                'Trebuchet MS, Helvetica, sans-serif',
                'Verdana, Geneva, sans-serif'
            ],
            supportAllValues: true
        },
        fontSize: {
            options: [ 10, 12, 14, 'default', 18, 20, 22 ],
            supportAllValues: true
        },
        htmlSupport: {
            allow: [
                {
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true
                }
            ]
        },
        htmlEmbed: {
            showPreviews: true
        },
        link: {
            decorators: {
                addTargetToExternalLinks: true,
                defaultProtocol: 'https://',
                toggleDownloadable: {
                    mode: 'manual',
                    label: 'Downloadable',
                    attributes: {
                        download: 'file'
                    }
                }
            }
        },
        mention: {
            feeds: [
                {
                    marker: '@',
                    feed: [
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                        '@sugar', '@sweet', '@topping', '@wafer'
                    ],
                    minimumCharacters: 1
                }
            ]
        },
        removePlugins: [
            'CKBox',
            'CKFinder',
            'EasyImage',
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            'MathType',
            'SlashCommand',
            'Template',
            'DocumentOutline',
            'FormatPainter',
            'TableOfContents'
        ]
    },
    {
        ckfinder:{
            
        }
    }
    ).then( 
        newEditor => {
        ckEditor = newEditor;

        const recognition = new webkitSpeechRecognition();

        let transcript = ''; 

        voiceButtonEn.addEventListener('click', function() {
            recognition.lang = 'en-US';
            recognition.start();
        });

        voiceButtonSi.addEventListener('click', function() {
            recognition.lang = 'si-LK';
            recognition.start();
        });

        recognition.addEventListener('result', function(event) {
            const result = event.results[0][0].transcript;
            
            if (event.results[0].isFinal) {

                if (result.toLowerCase().includes('full stop') || result.toLowerCase().includes('නැවතීම')) {
                    transcript = transcript.trim(); 
                    transcript += '. '; 
                } else {
                    transcript += result + ' '; 
                }
                ckEditor.setData(transcript);
            }
        });
    })
    .catch( error => {
        console.error( error );
    });
                    
            
            
</script>



<style>
#container { width: 1000px; margin: 20px auto; } .ck-editor__editable[role="textbox"] { /* editing area */ min-height: 200px; } .ck-content .image { /* block images */ max-width: 80%; margin: 20px auto; }
#view_form { border: 1px solid #bfbfbf; margin-top: 35px; padding: 10px 10px 10px 17px;}
p { margin-bottom: 0px !important;}
</style>

</body>

</html>
