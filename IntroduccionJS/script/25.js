// Itinerantes de Js , métodos de arreglo que se ejecutan 1 vez al menos por elemento

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

// ForEach (Utilizado para mostrar en pantalla o consola)
carrito.forEach((producto) => console.log(producto.nombre));

// Map (Utilizado en la creación de un nuevo arreglo)
const arreglo2 = carrito.map(
  (producto) => `${producto.nombre} - ${producto.precio}`
);

console.log(arreglo2);
