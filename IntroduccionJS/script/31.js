// Promises | Todas las API'S actuales cuentan con estas, representan valores que pueden estar disponibles ahora, en un futuro o nunca.

// Al ejecutarse una promesa, se mandan 2 valores automáticamente "resolve" se ejecuta cuando la promesa se cumple, "reject"
const usuarioAutenticado = new Promise((resolve, reject) => {
  const auth = false;

  if (auth) {
    resolve("Usuario Autenticado"); // El promise se CUMPLE
  } else {
    reject("No se pudo iniciar sesión"); // El promise NO se CUMPLE
  }
});

usuarioAutenticado
  .then((resultado) => console.log(resultado))
  .catch((error) => console.log(error));

// En las promesas existen 3 valores posibles
// Pending: No se ha cumplido, pero tampoco aún se ha rezachado.
// Fulfilled: Ya se cumplio.
// Rejected: Se ha rechazado o no se pudo cumplir.
