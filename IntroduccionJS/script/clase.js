let Total_apagar = 0, Descuento = 0.10, Total_descuento, Producto1 = 50, Producto2 = 51;

Total_apagar = Producto1 + Producto2;
Total_descuento = Total_apagar * Descuento;
Total_descuento = Total_descuento.toFixed(2);

if (Total_apagar <= 0) {
    console.log("La cantidad ingresada es invalida")
} else if (Total_apagar > 100) {
    console.log("Felicidades se le acredita un descuento del 10%");
    console.log(`Subtotal: ${Total_apagar}`);
    console.log(`Descuento: ${Total_descuento}`);
    console.log(`Total: ${Total_apagar - (Total_descuento)}`);
} else {
    console.log(`Su total a pagar es de ${Total_apagar}`)
}