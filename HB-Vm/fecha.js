// Cargado todo el DOM ejecutar la siguiente función
document.addEventListener('DOMContentLoaded', function () {
    iniciarApp();
});

function iniciarApp() {
    comprobarFecha(); // Muestra y oculta las secciones
}

function comprobarFecha() {
    const inputFecha = document.querySelector('#fecha');

    inputFecha.addEventListener('input', function (e) {

        // Conocer el número de día de la semana
        const dia = e.target.value;

        console.log(dia);

        // Condicional de fin de semana
        if (dia !== '2022-03-26') {
            // e.target.value = '';
            console.log('Fecha iccorrecta:c');
            fechaIncorrecta();
        } else {
            button_click()
            console.log('Fecha correcta:>')
        }
    });
}

function fechaIncorrecta() {
    const alerta = document.querySelector('.text_target2');
    alerta.textContent = 'Intenta de nuevo 👀';
}


function button_click() {
    animation_1_1();
    setTimeout(animation_1_2, 4 * 1000);

    confettiFalling();
    setTimeout(Delete_confetti, 3 * 1000);
    // window.setTimeout(Confetti(),13000);
}
