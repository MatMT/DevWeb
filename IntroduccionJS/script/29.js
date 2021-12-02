// --- Clases ---
// Los nombres de las clases siempre deben estar en mayúsculas
// Los datos son eviados por medio de un "constructor"

class Producto {
  constructor(nombre, precio) {
    this.nombre = nombre;
    this.precio = precio;
  }

  formatearProducto() {
    return `El Producto ${this.nombre} tiene un precio de : $${this.precio}`;
  }

  getPrice() {
    console.log(this.precio);
  }
}

const producto2 = new Producto(`Monitor curvo de 49`, 800);
const producto3 = new Producto(`Laptop`, 300);

// --- Herencia ---
// Pasa valores o atributos de un lado hacía el otro
class Libro extends Producto {
  constructor(nombre, precio, isbn) {
    super(nombre, precio);
    this.isbn = isbn;
  }

  formatearProducto() {
    return `${super.formatearProducto()} y su ISBN es ${this.isbn}`;
  }

  getPrice() {
    super.getPrice();
    console.log("Y si hay en existencia");
  }
}

const libro = new Libro("JavaScript la Revolución", 120, "23342");

console.log(libro.formatearProducto());
console.log(libro.getPrice());
console.log(producto2.formatearProducto());
