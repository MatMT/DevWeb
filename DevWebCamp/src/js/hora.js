(function () {
    const horas = document.querySelector('#horas');

    if (horas) {
        let busqueda = {
            categoria_id: '',
            dia: ''
        }

        const categoria = document.querySelector('[name="categoria_id"]');
        const dias = document.querySelectorAll('[name="dia"]');
        const inputHiddenDia = document.querySelector('[name="dia_id"]');
        const inputHiddenHora = document.querySelector('[name="hora_id"]');

        categoria.addEventListener('change', terminoBusqueda);
        dias.forEach(dia => {
            dia.addEventListener('change', terminoBusqueda)
        });


        function terminoBusqueda(e) {
            busqueda[e.target.name] = e.target.value;

            // Reiniciar los campos ocultos y el selectode horas
            inputHiddenHora.value = '';
            inputHiddenDia.value = '';

            // Deshabilitar la hora previa
            const horaPrevia = document.querySelector('.horas__hora--selected');

            if (horaPrevia) {
                horaPrevia.classList.remove('horas__hora--selected');
            }


            // Mientras algún campó este vacío
            if (Object.values(busqueda).includes('')) {
                return;
            }

            // Función asíncrona al consultar API
            buscarEventos();
        }

        // Función asíncrona al consultar API
        async function buscarEventos() {
            const { categoria_id, dia } = busqueda;

            const url =
                `/api/eventos-horario?dia_id=${dia}&categoria_id=${categoria_id}`;

            const resultado = await fetch(url);
            const eventos = await resultado.json();

            obtenerHorasDisponibles(eventos);
        }

        // Se determinan las horas disponibles en base a la consulta
        function obtenerHorasDisponibles(eventos) {
            // Reiniciar las horas -----

            // Se toman los elemenot LI
            const listadoHoras = document.querySelectorAll("#horas li");
            listadoHoras.forEach(li => li.classList.add("horas__hora--deshabilitada"));

            // Comprobrar eventos ya tomados y quitar la variable de deshabilitado
            const horasTomadas = eventos.map(evento => evento.hora_id);

            // Se convierte el NodeList en un Array
            const listadoHorasArray = Array.from(listadoHoras);

            // Se filtra negando el elemento que ya ha sido tomado
            const resultado = listadoHorasArray.filter(li => !horasTomadas.includes(li.dataset.horaId));

            // Se retira la clase de deshabilitada
            resultado.forEach(li => li.classList.remove('horas__hora--deshabilitada'));

            // Selector Css de los elementos sin la clase deshabilitada
            const horasDisponibles = document.querySelectorAll('#horas li:not(.horas__hora--deshabilitada)');

            const horasDeshabilitadas = document.querySelectorAll('.horas__hora--deshabilitada');

            horasDeshabilitadas.forEach(hora => hora.removeEventListener('click', seleccionarHora));

            horasDisponibles.forEach(hora => hora.addEventListener('click', seleccionarHora));
        }

        function seleccionarHora(e) {
            // Deshabilitar la hora previa
            const horaPrevia = document.querySelector('.horas__hora--selected');

            if (horaPrevia) {
                horaPrevia.classList.remove('horas__hora--selected');
            }

            // Agrear una clase
            const liSeleccionado = e.target;
            liSeleccionado.classList.add("horas__hora--selected")

            inputHiddenHora.value = e.target.dataset.horaId;

            // Llenar el campo oculto de día
            inputHiddenDia.value = document.querySelector('[name="dia"]:checked').value;
        }
    }
})();