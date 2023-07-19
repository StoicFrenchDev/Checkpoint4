/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

require('bootstrap');


// profile picture form (show file size)

var input = document.getElementById('upload-cat-picture');
input.addEventListener('change', (e) => {
    let fileSize = input.files[0].size;
    let fileSizeText = '';

    if (fileSize < 1048576) {
        fileSizeText = (fileSize / 1024).toFixed(2) + ' KB';
    } else if (fileSize < 1073741824) {
        fileSizeText = (fileSize / 1048576).toFixed(2) + ' MB';
    }
    let fileSizeElement = document.querySelector('.file-size');
    fileSizeElement.textContent = 'File size: ' + fileSizeText;
});


setTimeout(function() {
    var flashMessage = document.querySelector('div.alert');
    if (flashMessage) {
        flashMessage.remove();
    }
}, 3000);