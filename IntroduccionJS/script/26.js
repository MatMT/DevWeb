// This
// Hace referencia a los mismos varoles del objeto del cual son llamadoss

// NOTA : Los arrow functions no funcionan, puesto que no hacen referencia al mismo objeto si no a la ventana global "Window"
const reservación = {
  nombre: "Mateo",
  informacion: () => {
    console.log(`${this.nombre}`);
  },
};

// Object literal
const reservación2 = {
  nombre: "Mateo",
  apellido: "Elías",
  total: "100",
  pagada: false,
  informacion: function () {
    // prettier-ignore
    console.log(`El cliente ${this.nombre} reservó y su cantidad a pagar ${this.total}`);
  },
};

reservación.informacion();
reservación2.informacion();
