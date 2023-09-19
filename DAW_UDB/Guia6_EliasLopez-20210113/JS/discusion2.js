const fileInput = document.getElementById('fileInput');
const resultDiv = document.getElementById('result');

fileInput.addEventListener('change', validateFile);

function validateFile() {
    const allowedExtensions = /\.(jpg|jpeg|png|gif)$/i;
    const selectedFile = fileInput.files[0];

    if (selectedFile && allowedExtensions.test(selectedFile.name)) {
        resultDiv.innerHTML = 'Archivo válido';
        resultDiv.className = 'valid';
    } else {
        resultDiv.innerHTML = 'Archivo no válido. Selecciona un archivo de imagen (jpg, jpeg, png, gif).';
        resultDiv.className = 'invalid';
    }
}