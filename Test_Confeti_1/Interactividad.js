// Definiendo variables sobre las etiquetas a interactuar
const boton = document.querySelector('input');

const confeti = document.getElementById("box");

const izquierda = document.querySelector('.ldoor');

const derecha = document.querySelector('.rdoor');


// Función del confeti

function confettiFalling() {

    var box = document.getElementById("box");
    var colors = ['red', 'green', 'blue', 'yellow', 'purple', 'orange', 'pink'];

    for (var i = 0; i < 1000; i++) {
        
        // Create 1000 DIV elements for confetti
        var div = document.createElement("div");
        div.classList.add("confetti");
        box.appendChild(div);
    }

    var confetti = document.querySelectorAll('.confetti');

    for (var i = 0; i < confetti.length; i++) {
        
        var size = Math.random() * 0.01 * [i];

        confetti[i].style.width = 5 + size + 'px';
        confetti[i].style.height = 16 + size + 'px';
        confetti[i].style.left = Math.random() * innerWidth + 'px';

        var background = colors[Math.floor(Math.random() * colors.length)];
        confetti[i].style.backgroundColor = background;

        box.children[i].style.transform = "rotate("+ size*[i] +"deg)";
    }
    }

// Funciones propias de la presentación y tiempo en pantalla de los elementos

    function animation_1_1() {
        izquierda.classList.add('ldoor__animation');
        derecha.classList.add('rdoor__animation');
        boton.classList.add('d_none');

    }

    function animation_1_2() {
        derecha.classList.remove('rdoor');
        derecha.classList.remove('rdoor__animation');
        izquierda.classList.remove('ldoor');
        izquierda.classList.remove('ldoor__animation');
        
    }

    function animation_2_1() {
    document.getElementById('button_').classList.remove('boton');
    console.log("Funciona!");
    }

    function Delete_confetti() {
        confeti.classList.remove('box');
    }


    function button_click(){
        animation_1_1();
        setTimeout(animation_1_2, 4*1000);
        
        confettiFalling();
        setTimeout(Delete_confetti, 3*1000);
        // window.setTimeout(Confetti(),13000);
    }


