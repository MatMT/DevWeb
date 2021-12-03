// --- Prototype ---
// Son clases asociadas a un tipo de objeto

function Producto(nombre, precio) {
  this.nombre = nombre;
  this.precio = precio;
}

function Cliente(nombre, apellido) {
  this.nombre = nombre;
  this.apellido = apellido;
}

// Crea funciones que solo se utilizan en un objeto especifico.
Producto.prototype.formatearProducto = function () {
  return `El Producto ${this.nombre} tiene un precio de : $${this.precio}`;
};

const producto2 = new Producto(`Monitor curvo de 49`, 800);
const producto3 = new Producto(`Laptop`, 300);
const cliente = new Cliente("Juan", "De la torre");

console.log(cliente);

console.log(producto2.formatearProducto());
console.log(producto3.formatearProducto());
