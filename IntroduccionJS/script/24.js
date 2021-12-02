// Estructuras de repetición

// For Loop | Para

// for (let i = 0; i < 10; i++) {
//   console.log(i);
// }

// for (let i = 1; i <= 100; i++) {
//   if (i % 2 == 0) {
//     console.log(`El número ${i} es PAR`);
//   } else {
//     console.log(`El número ${i} es IMPAR`);
//   }
// }

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

for (let i = 0; i < carrito.length; i++) {
  console.log(carrito[i].nombre);
}

// While Loop | Mientras | Evalua condición y luego ejecuta

// Indice
// let i = 20;
//    Condición
// while (i < 10) {
//   console.log("Desde el while loop");
//    Incremento
//   i++;
// }

// Do While Loop | Repetir | Ejecuta 1 vez y luego evalua
let i = 0;

do {
  console.log(i);
  i++;
} while (i < 10);
