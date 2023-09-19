function validate() {
    const validationType = document.getElementById('validationType').value;
    const inputData = document.getElementById('inputData').value;
    const resultDiv = document.getElementById('result');

    let regexPattern;

    switch (validationType) {
        case 'ipv4':
            regexPattern = /^(\d{1,3}\.){3}\d{1,3}$/;
            break;
        case 'url':
            regexPattern = /^(http|https|ftp):\/\/[\w\-]+(\.[\w\-]+)+([\w\-\.,@?^=%&:/~\+#]*[\w\-\@?^=%&/~\+#])?$/;
            break;
        case 'email':
            regexPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            break;
        default:
            resultDiv.innerHTML = 'Selecciona un tipo de validación válido.';
            resultDiv.className = 'invalid';
            return;
    }

    if (regexPattern.test(inputData)) {
        resultDiv.innerHTML = 'Válido';
        resultDiv.className = 'valid';
    } else {
        resultDiv.innerHTML = 'No válido';
        resultDiv.className = 'invalid';
    }
}