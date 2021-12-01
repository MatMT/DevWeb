// Array Methods
// Contienen el nombre del arreglo como variable seguido de un punto y la función

const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo"];

const carrito = [
  { nombre: "Monitor de 20P", precio: 500 },
  { nombre: "Televisión de 50P", precio: 700 },
  { nombre: "Tablet", precio: 300 },
  { nombre: "Audifonos", precio: 200 },
  { nombre: "Teclado", precio: 50 },
  { nombre: "Celular", precio: 500 },
  { nombre: "Bocinas", precio: 500 },
  { nombre: "Laptop", precio: 800 },
];

//forEach (Forma ambigua de encontrar un elemento en un arreglo)
meses.forEach(function (mes) {
  if (mes == "Marzo") {
    console.log("Marzo existe bro");
  }
});

// Includes (Para arreglos planos)
let resultado = meses.includes("Marzo");

// Some (Ideal para arreglo de objetos o complejos)
resultado = carrito.some(function (producto) {
  return producto.nombre === "Celular PRO";
});

// Reduce (Suma de los valores de los objetos)
resultado = carrito.reduce(function (total, producto) {
  return total + producto.precio;
}, 0);

// Filter (Más útil y utilizado)
resultado = carrito.filter(function (producto) {
  return producto.precio > 400;
});

resultado = carrito.filter(function (producto) {
  return producto.nombre !== "Celular";
});

console.log(resultado);
