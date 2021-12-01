// Funciones con parametros y argumentos

function sumar(num1 = 0, num2 = 0) {
  // num1, num2 son parametros
  console.log(num1 + num2);
}

sumar(1, 3);
sumar(2, 3);
sumar(5, 2);

const sumar2 = function (n1, n2) {
  console.log(n1 + n2);
};

sumar2(4, 10);
