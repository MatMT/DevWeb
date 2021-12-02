// Estructuras de control (switch)

const metodoPago = "efectivo";

switch (metodoPago) {
  case "tarjeta":
    console.log("Pagaste con tarjeta");
    break;
  case "efectivo":
    console.log("Pagaste en efectivo");
    break;
  case "bitcoin":
    console.log("Pagaste con bitcoin");
    break;
  default:
    console.log("Aún no has pagado");
    break;
}
