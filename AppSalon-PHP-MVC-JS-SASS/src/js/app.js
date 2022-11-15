let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

// Objetos funcionan como un let
const cita = {
    nombre: '',
    fecha: '',
    hora: '',
    servicios: []
}

// Cargado todo el DOM ejecutar la siguiente función
document.addEventListener('DOMContentLoaded', function () {
    iniciarApp();
});

function iniciarApp() {
    mostrarSeccion(); // Muestra y oculta las secciones
    tabs(); // Cambia la sección cuando se presiona los tabs
    botonesPaginador(); // Agrega o quita los botones del paginador
    paginaSiguiente();
    paginaAnterior();

    consultarAPI(); // Consulta la API en el backend de PHP
}

function mostrarSeccion() {
    // Ocultar la sección que tenga la clase de mostar
    const seccionAnterior = document.querySelector('.mostrar');
    if (seccionAnterior) {
        seccionAnterior.classList.remove('mostrar');
    }

    // Seleccionar la sección con el paso...
    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector);
    seccion.classList.add('mostrar');

    // Quita la clase .actual al tab anterior
    const tabAnterior = document.querySelector('.actual');
    if (tabAnterior) {
        tabAnterior.classList.remove('actual');
    }

    // Resalta el tab actual
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');
}

function tabs() {
    const botones = document.querySelectorAll('.tabs button');
    botones.forEach(boton => {
        boton.addEventListener('click', function (e) {
            paso = parseInt(e.target.dataset.paso);
            mostrarSeccion();
            botonesPaginador()
        });
    });
}

function botonesPaginador() {
    const paginaAnterior = document.querySelector('#anterior');
    const paginaSiguiente = document.querySelector('#siguiente');

    if (paso === 1) {
        paginaAnterior.classList.add('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    } else if (paso === 3) {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.add('ocultar');
    } else {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }

    mostrarSeccion();
}

function paginaAnterior() {
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', function () {
        if (paso <= pasoInicial) return; // Corta el código
        paso--;
        botonesPaginador();
    });
}

function paginaSiguiente() {
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', function () {
        if (paso >= pasoFinal) return; // Corta el código
        paso++;
        botonesPaginador();
    });
}

// Funciones asincronas
async function consultarAPI() {

    try {
        const url = 'http://localhost:3000/api/servicios';
        const resultado = await fetch(url); // Await incluido con Async
        const servicios = await resultado.json();
        mostarServicios(servicios);
    } catch (error) {
        console.log(error);
    }
}

function mostarServicios(servicios) {
    // Iterando por cada uno de los resultados del JSON
    servicios.forEach(servicio => {
        const { id, nombre, precio } = servicio;

        // Añadiendo Scripting

        const nombreServicio = document.createElement('P');
        nombreServicio.classList.add('nombre-serivicio');
        nombreServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.classList.add('precio-servicio');
        precioServicio.textContent = `$${precio}`;

        const servicioDiv = document.createElement('DIV');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = id;
        servicioDiv.onclick = function () {
            seleccionarServicio(servicio);
        }

        // Anidando elementos
        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);

        document.querySelector('#servicios').appendChild(servicioDiv);
    })
}

function seleccionarServicio(servicio) {
    // Extraer el arreglo de servicios
    const { id } = servicio;
    const { servicios } = cita;

    // Comprobar si un servicio ya fue agregado

    // Tomamos una copia de servicios y agregamos un nuevo servicio
    cita.servicios = [...servicios, servicio];

    const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);
    divServicio.classList.add('seleccionado');

    console.log(servicio);
}