// Desconstruyendo objetos
const producto = {
  nombreProducto: "Monitor 20 Pulgadas",
  precio: 300,
  disponible: true,
};

// Creando variable en base a una propiedad (Forma anterior)
// const precioProducto = producto.precio;
// const nombreProducto = producto.nombreProducto;

// console.log(precioProducto);
// console.log(nombreProducto);

// Destructuring
const { precio, nombreProducto } = producto; // Se crea la variable y se extrae en un solo paso, tomando en cuenta el mismo nombre de la propiedad en el objeto, todo esto en una sola línea
// const { nombreProducto } = producto;

console.log(precio);
console.log(nombreProducto);
