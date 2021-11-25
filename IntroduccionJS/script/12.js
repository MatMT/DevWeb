// "use strict"; Uso estricto en Js

// Objetos
const producto = {
  nombreProducto: "Monitor 20 Pulgadas",
  precio: 300,
  disponible: true,
};

// Teorícamente una constante no debería ser modificada, más sin embargo al declararse de esta forma un objeto si es posible

// Para evitar esto podemos utilizar la siguiente función
Object.freeze(producto); // .freeze .seal

// producto.imagen = "imagen.jpg"; // De modo que esta línea no se esta ejecutando

// Tampoco podemos modificar el valor de alguna propiedad
producto.precio = "NUEVO PRECIO";
// Así mismo con el método Freeze no podemos eliminar propiedad alguna
delete producto.precio;

// --- Conocer si un objeto esta "congelado" ---
// console.log(Object.isFrozen(producto));

// --- Por otro lado tenemos el método "seal" que no nos permite agrar ni eliminar pero si MODIFICAR ---
// Object.seal(producto);

console.log(producto);
