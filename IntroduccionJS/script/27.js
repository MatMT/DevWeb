// POO - Programación orientada a objetos

/* -- Objecto Literal -- */
// Un objeto tiene muchas variables en una sola
const producto = {
  nombre: "Tablet",
  precio: 500,
};

// Objecto Constructor | Más dinámicas, destinadas al uso de clases
// Una clase es el contenedor de todas las formas, todos los métodos y funciones que va a tener un objeto en él

// Parámetros | Parámetros formales (información entre paréntesis)
function Producto(nombre, precio, conexion) {
  this.nombre = nombre;
  this.precio = precio;
  this.conexion = conexion;
}

// Argumentos | Parámetros reales (información entre paréntesis)
// Se crea una multitud de objetos, algo similar, una especie de "clase"
const producto2 = new Producto(`Monitor curvo de 49`, 800, "Lan");
const producto3 = new Producto(`Laptop`, 300, "Wifi");
const producto4 = new Producto(`Smartphone`, 300, "Datos");
const producto5 = new Producto(`SmartWatch`, 300, "Wifi");

console.log(producto2);
console.log(producto3);
console.log(producto4);
console.log(producto5);
