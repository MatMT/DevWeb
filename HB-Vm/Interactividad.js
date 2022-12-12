// Definiendo variables sobre las etiquetas a interactuar
const boton = document.querySelector('input');

// Elementos de la tergeta inicial
const targeta = document.getElementById('targeta');

const target1 = document.querySelector('.text_target');
const target2 = document.querySelector('.target__text');
const target3 = document.querySelector('.detalle');

const target4 = document.querySelector('.target__buttom');
const target5 = document.querySelector('.text_target2');
// 

const confeti = document.getElementById("box");

const izquierda = document.querySelector('.ldoor');

const derecha = document.querySelector('.rdoor');


// Función del confeti
function confettiFalling() {

    var box = document.getElementById("box");
    var colors = ['aqua', 'aquamarine', 'plum', 'darkviolet', 'purple', 'turquoise', 'mediumvioletred'];

    for (var i = 0; i < 1100; i++) {

        // Create 1000 DIV elements for confetti
        var div = document.createElement("div");
        div.classList.add("confetti");
        box.appendChild(div);
    }

    var confetti = document.querySelectorAll('.confetti');

    for (var i = 0; i < confetti.length; i++) {

        var size = Math.random() * 0.01 * [i];

        confetti[i].style.width = 18 + size + 'px';
        confetti[i].style.height = 4 + size + 'px';
        confetti[i].style.left = Math.random() * innerWidth + 'px';

        var background = colors[Math.floor(Math.random() * colors.length)];
        confetti[i].style.backgroundColor = background;

        box.children[i].style.transform = "rotate(" + size * [i] + "deg)";
    }
}

// Funciones propias de la presentación y tiempo en pantalla de los elementos

function animation_1_1() {
    izquierda.classList.add('ldoor__animation');
    derecha.classList.add('rdoor__animation');
    targeta.classList.add('d_none');
    boton.classList.add('d_none');
    target1.classList.add('d_none');
    target2.classList.add('d_none');
    target3.classList.add('d_none');
    target4.classList.add('d_none');
    target5.classList.add('d_none');

}

function animation_1_2() {
    derecha.classList.remove('rdoor');
    derecha.classList.remove('rdoor__animation');
    izquierda.classList.remove('ldoor');
    izquierda.classList.remove('ldoor__animation');

}

function animation_2_1() {
    document.getElementById('button_').classList.remove('boton');
}

function Delete_confetti() {
    confeti.classList.remove('box');
}



