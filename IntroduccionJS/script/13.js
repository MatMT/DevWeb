// Unir Objetos
// Según la buena practica no se deben modificar los datos originales

const producto = {
  nombreProducto: "Monitor 20 Pulgadas",
  precio: 300,
  disponible: true,
};

const medidas = {
  peso: "kg",
  meida: "1m",
};

const newProduct = { ...producto, ...medidas };

console.log(producto);
console.log(newProduct);
