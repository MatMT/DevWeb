// Variables globales
var palabras = [
    { palabra: "a", definicion: "Letra inicial del alfabeto español" },
    { palabra: "b", definicion: "Letra del alfabeto español" },
    { palabra: "c", definicion: "Letra del alfabeto español" },
    // ...
    { palabra: "z", definicion: "Letra final del alfabeto español" },
  ];
  
  // Función para cargar la lista de palabras
  function cargarListaPalabras() {
    var lstPalabras = document.getElementById("lstPalabras");
    for (var i = 0; i < palabras.length; i++) {
      var option = document.createElement("option");
      option.textContent = palabras[i].palabra;
      option.value = palabras[i].palabra;
      lstPalabras.appendChild(option);
    }
  }
  
  // Función para filtrar la lista de palabras
  function filtrarListaPalabras() {
    var txtFiltro = document.getElementById("txtFiltro").value;
    var lstPalabras = document.getElementById("lstPalabras");
    lstPalabras.innerHTML = "";
    for (var i = 0; i < palabras.length; i++) {
      if (palabras[i].palabra.toLowerCase().indexOf(txtFiltro.toLowerCase()) >= 0) {
        var option = document.createElement("option");
        option.textContent = palabras[i].palabra;
        option.value = palabras[i].palabra;
        lstPalabras.appendChild(option);
      }
    }
  }
  
  // Función para mostrar la definición de una palabra
  function mostrarDefinicion() {
    var txtDefinicion = document.getElementById("txtDefinicion");
    var lstPalabras = document.getElementById("lstPalabras");
    var palabraSeleccionada = lstPalabras.value;
    for (var i = 0; i < palabras.length; i++) {
      if (palabras[i].palabra == palabraSeleccionada) {
        txtDefinicion.textContent = palabras[i].definicion;
        break;
      }
    }
  }
  
  // Eventos
  document.getElementById("txtFiltro").addEventListener("keyup", filtrarListaPalabras);
  document.getElementById("lstPalabras").addEventListener("dblclick", mostrarDefinicion);
  document.getElementById("btnMostrarDefinicion").addEventListener("click", mostrarDefinicion);
  