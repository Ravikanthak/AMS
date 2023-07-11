<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap 4 Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="{{asset('ck/styles.css')}}">
</head>
<body>

<main>
    <div class="centered">
        
        <form method="POST" action="/ckeditor_func" id="myForm">
            @csrf
            <textarea class="editor" name="description" id="editor" class="form-control">
                
            </textarea>
            <button type="submit">Submit</button>

        </form>
    </div>
</main>

<button id="voiceInputBtn">Start Voice Input</button>


<script src="{{asset('ck/ckeditor.js')}}"></script>
<script>


const watchdog = new CKSource.EditorWatchdog();
window.watchdog = watchdog;

watchdog.setCreator((element, config) => {
  return CKSource.Editor
    .create(element, config)
    .then(editor => {
      return editor;
    });
});

watchdog.setDestructor(editor => {
  return editor.destroy();
});

watchdog.on('error', handleError);

watchdog
  .create(document.querySelector('.editor'), {
    licenseKey: '',
  })
  .then(editor => {
    CKSource.Editor.instances['editor'] = editor;

    document.getElementById('voiceInputBtn').addEventListener('click', function() {
      if ('SpeechRecognition' in window || 'webkitSpeechRecognition' in window) {
        var recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
        recognition.lang = 'en-US'; // Set the desired language

        recognition.onresult = function(event) {
          var result = event.results[0][0].transcript;
          editor.setData(result);
        };

        recognition.start();
      } else {
        alert('Speech Recognition is not supported in this browser.');
      }
    });
  })
  .catch(handleError);

function handleError(error) {
  console.error(error);
}






    // const form = document.getElementById('myForm');
    // const editor = document.getElementById('editor');

    // form.addEventListener('submit', function() {
    //     // Convert text content to HTML
    //     const htmlContent = editor.value;
    //     const div = document.createElement('div');
    //     div.innerHTML = htmlContent;
    //     const convertedHTML = div.innerHTML;

    //     // Update the textarea value with the converted HTML
    //     editor.value = convertedHTML;
    // });




//     ClassicEditor
//   .create(document.querySelector('.editor'))
//   .then(editor => {
//     CKSource.Editor.instances['editor'] = editor;
//   })
//   .catch(error => {
//     console.error(error);
//   });



    // const watchdog = new CKSource.EditorWatchdog();
    
    // window.watchdog = watchdog;
    
    // watchdog.setCreator( ( element, config ) => {
    //     return CKSource.Editor
    //         .create( element, config )
    //         .then( editor => {
    //             return editor;
    //         } )
    // } );
    
    // watchdog.setDestructor( editor => {
    //     return editor.destroy();
    // } );
    
    // watchdog.on( 'error', handleError );
    
    // watchdog
    //     .create( document.querySelector( '.editor' ), {
    //         licenseKey: '',			
            
    //     } )
    //     .catch( handleError );
    
    // function handleError( error ) {
    //     console.error( error );
    // }
    
</script>


</body>
</html>