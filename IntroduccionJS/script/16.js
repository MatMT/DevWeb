// Declaración de Función

sumar();

function sumar() {
  console.log(10 + 10);
}

// Joistin (La lectura de JavaScript se da 2 veces por tanto en el 1° se registra o detecta funciones y en el 2° las ejecuta y llama las funciones, por tanto el orden al llamar las funciones no es necesariamente lineal)

// Expresión de la función
const sumar2 = function () {
  console.log(3 + 3);
};

sumar2();

// IIFE (útil para proteger variables de otros archivos)
(function () {
  console.log("Esta es una función");
})();
