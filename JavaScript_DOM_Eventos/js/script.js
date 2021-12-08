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

console.log(1);

window.onload = function () {
  console.log(3);
};

window.addEventListener("load", function () {
  // Load espera a que el Js y que los archivos del Html estén listos
  console.log(2);
});

document.addEventListener("DOMContentLoaded", function () {
  // Solo espera por el Html, no por el Css o imagenes
  console.log(4);
});

console.log(5);

window.onscroll = function () {
  console.log("scrolling...");
};
