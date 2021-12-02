// Estructuras de control (if)

// Un solo signo de "=" asigna una variable
// Dos signos de "==" establecen una comparación
// Tres signos de "===" estableces una comparación extricta o exacta

// const puntaje = 500;
// if (puntaje !== 500) {
//   console.log("Si el puntaje es igual a 500");
// } else {
//   console.log("El puntaje no es igual");
// }

// const efectivo = 1000;
// const carrito = 800;

// if (efectivo > carrito) {
//   console.log("Si es posible realizar el pago");
// } else {
//   console.log("Credito insuficiente");
// }

const rol = "EDITOR";

if (rol === "ADMIN") {
  console.log("Acceso a todo el sistema");
} else if (rol === "EDITOR") {
  console.log("Acceso a la biblioteca");
} else {
  console.log("No tienes acceso");
}
