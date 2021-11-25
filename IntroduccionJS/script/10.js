// Objetos

// Definición normal de variables
// const nombreProducto = "Monitor 20 Pulgadas";
// const precio = 300;
// const disponible = "true";

// --- Sintaxis al crear y definir un objeto ---
const producto = {
  nombreProducto: "Monitor 20 Pulgadas", //Cada una de estas se considera una propiedad
  precio: 300,
  disponible: true,
};

// console.log(producto.precio); //Acceder a sus propiedades
// console.log(producto["precio"]); //Acceder a sus propiedades de forma menos optima

// --- Agregar propiedades ---
producto.imagen = "imagen.jpg";

// --- Eliminar propiedades ---
delete producto.disponible;

console.log(producto);
