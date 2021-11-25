// Arreglos o Arrays

const numeros = [10, 20, 30, 40, 50];
console.table(numeros);

// Un arreglo puede contener de todo dentro de sí mismo incluso otros arreglos
const arreglo = [
  "Hola",
  10,
  true,
  "si",
  null,
  { nombre: "Juan", trabajo: "Programador" },
  [1, 2, 3],
];

// Acceder a los valores dentro de un arreglo, y esto mediante su indice
// console.log(numeros[0]);
// console.log(numeros[1]);
// console.log(numeros[2]);
// console.log(numeros[3]);
// console.log(numeros[4]);

// Conocer la extensión de un arreglo
// console.log(meses.length);

// --- Recorrer todo un arreglo ---
// numeros.forEach(function (numero) { // Por cada uno de ellos
//   console.log(numero);
// });

// --- Agregar un elemento al final de la posición del arreglo ---
numeros.push(60, 70, 80);

// --- Modificar los valores desde el inicio del arreglo ---
numeros.unshift(-10, -20, -30);

console.table(numeros);

const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo"];

// meses.pop(); // Elimina el último elemento
// meses.shift(); // Elimina el primer elemento
// meses.splice(2, 1); // --- Elimina según: 1° valor: indice, 2° valor: cantidad a... ---
// console.table(meses);

// Sin embargo hoy en día se recomienda no modificar los valores originales por ello se recomienda

// --- Rest Operator | Spread Operator ---

const newArreglo = ["Diciembre", ...meses, "Junio"];
console.log(newArreglo);
