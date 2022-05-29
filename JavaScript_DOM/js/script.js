// |*---- querySelector ----*|
const heading = document.querySelector(".header__texto h2"); // 0 o 1 Elementos
heading.textContent = "Nuevo Heading";
console.log(heading);

// -- querySelectorAll --
const enlaces = document.querySelectorAll(".navegacion a");
// enlaces[0].textContent = "Nuevo texto para Enlace";
// enlaces[0].href = "https://google.com";
enlaces[0].classList.add("nueva-clase");
enlaces[0].classList.remove("nueva-clase");

// -- getElementById
const heading2 = document.getElementById("heading");

// |*---- Generar un nuevo enlace ----*|
const nuevoEnlace = document.createElement("A");

// Agregar el href
nuevoEnlace.href = "https://google.com";

// Agregar el texto
nuevoEnlace.textContent = "Tienda Virtual";

// Agregar la clase
nuevoEnlace.classList.add("navegacion__enlace");

// Agregarlo al Documento
const navegacion = document.querySelector(".navegacion");
navegacion.appendChild(nuevoEnlace);

// Eventos

// console.log(1);

// window.onload = function () {
//   console.log(3);
// };

// window.addEventListener("load", function () {
// Load espera a que el Js y que los archivos del Html estén listos
//   console.log(2);
// });

// document.addEventListener("DOMContentLoaded", function () {
// Solo espera por el Html, no por el Css o imagenes
//   console.log(4);
// });

// console.log(5);

// window.onscroll = function () {
//   console.log("scrolling...");
// };

// |*---- Seleccionar elementos y asociarlos a un evento ----*|
// const btnEnviar = document.querySelector(".boton--primario");
// btnEnviar.addEventListener("click", function (evento) {
// console.log(evento);
//   evento.preventDefault(); // Elimina la función por defecto, en este caso recargar una página al dar click a un Input Submit
//   console.log("enviando formulario");
// });

// |*---- Eventos de los Inputs y Textarea ----*|

const datos = {
  nombre: "",
  email: "",
  mensaje: "",
};

const nombre = document.querySelector("#nombre");
const email = document.querySelector("#email");
const mensaje = document.querySelector("#mensaje");
const formulario = document.querySelector(".formulario");

nombre.addEventListener("input", readText);
email.addEventListener("input", readText);
mensaje.addEventListener("input", readText);

// |*---- El Evento de Submit ----*|
formulario.addEventListener("submit", function (evento) {
  evento.preventDefault();

  // Validar el formulario

  const { nombre, email, mensaje } = datos;
  if (
    document.querySelector(".error") === null &&
    document.querySelector(".exito") === null
  ) {
    if (nombre === "" || email === "" || mensaje === "") {
      mostrarAlert("Todos los campos son obligatorios", true);
      return; // Corta la ejecución del código
    } else {
      // Crear otra alerta de Enviado correctamente
      mostrarAlert("Los datos se han enviado exitosamente");
    }
  }
});

function readText(e) {
  // console.log(e.target.value);
  datos[e.target.id] = e.target.value;
  // console.log(datos);
}

function mostrarAlert(mensaje, error = null) {
  const alerta = document.createElement("P");
  alerta.textContent = mensaje;

  if (error) {
    alerta.classList.add("error");
  } else {
    alerta.classList.add("exito");
  }

  formulario.appendChild(alerta);

  // Desaparecer alerta
  setTimeout(() => {
    alerta.remove();
  }, 3000);
}
