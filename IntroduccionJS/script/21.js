// Arrow Functions
// Función solamente en la expresión de funciones y Array Methods
// Se da el Return de forma implícita

const sumar2 = (n1, n2) => console.log(n1 + n2);
sumar2(5, 10);

const aprendiendo = (tecnologia) => console.log(`aprendiendo ${tecnologia}`);
aprendiendo("JavaScript");

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

//forEach
meses.forEach((mes) => {
  if (mes == "Marzo") {
    console.log("Marzo existe bro");
  }
});

let resultado;

// Some (Ideal para arreglo de objetos o complejos)
resultado = carrito.some((producto) => producto.nombre === "Celular");

// Reduce (Suma de los valores de los objetos)
resultado = carrito.reduce((total, producto) => total + producto.precio, 0);

// Filter (Más útil y utilizado)
resultado = carrito.filter((producto) => producto.precio > 400);
resultado = carrito.filter((producto) => producto.nombre !== "Celular");

console.log(resultado);
