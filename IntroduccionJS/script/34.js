// Fetch API
async function obtenerEmpleados() {
  const url = "script/empleados.json";
  //   fetch(url)
  //     // Definimos que la respuesta es un .json
  //     .then((resultado) => resultado.json())
  //     .then((datos) => {
  //       //   console.log(datos.empleados);
  //       const { empleados } = datos;
  //       //   console.log(empleados);

  //       empleados.forEach((empleados) => {
  //         console.log(empleados.id);
  //         console.log(empleados.nombre);
  //         console.log(empleados.puesto);
  //       });
  //     });

  const resultado = await fetch(url);
  const datos = await resultado.json();
  console.log(datos);
}

obtenerEmpleados();
