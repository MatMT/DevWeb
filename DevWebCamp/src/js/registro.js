import Swal from "sweetalert2";

(function () {
    let eventos = [];

    const resumen = document.querySelector('#registro-resumen');

    if (resumen) {
        const eventosBoton = document.querySelectorAll('.evento__agregar');
        eventosBoton.forEach(boton => {
            boton.addEventListener('click', seleccionarEvento);
        });

        const formularioRegistro = document.querySelector('#registro');
        formularioRegistro.addEventListener('submit', submitForm);

        mostrarEventos();

        function seleccionarEvento({ target }) {
            if (eventos.length < 5) {
                // Deshabilitar el evento
                target.disabled = true;

                // Agrear
                eventos = [...eventos, {
                    id: target.dataset.id,
                    titulo: target.parentElement.querySelector('.evento__nombre').textContent.trim()
                }];

                mostrarEventos();
            } else {
                Swal.fire({
                    'title': 'Error',
                    'text': 'Máximo 5 eventos por registro',
                    'icon': 'error',
                    'confirmButtonText': 'Ok'
                })
            }
        }

        function mostrarEventos() {
            limpiarEventos();

            if (eventos.length > 0) {
                eventos.forEach(evento => {
                    const eventoDOM = document.createElement('DIV');
                    eventoDOM.classList.add('registro__evento');

                    const titulo = document.createElement('H3');
                    titulo.classList.add('registro__nombre');
                    titulo.textContent = evento.titulo;

                    const botonEliminar = document.createElement('BUTTON');
                    botonEliminar.classList.add('registro__eliminar');
                    botonEliminar.innerHTML = `<i class="fa-solid fa-trash"></i>`;

                    botonEliminar.onclick = function () {
                        eliminarEvento(evento.id);
                    }

                    // Renderizar en el html
                    eventoDOM.appendChild(titulo);
                    eventoDOM.appendChild(botonEliminar);
                    resumen.appendChild(eventoDOM);
                })
            } else {
                const noRegistro = document.createElement('P');
                noRegistro.textContent = 'No hay eventos, selecciona hasta 5 posibles eventos';
                noRegistro.classList.add('registro__texto');

                // Renderizar en DOM
                resumen.appendChild(noRegistro);
            }
        }

        function eliminarEvento(id) {
            eventos = eventos.filter(evento => evento.id !== id);

            const botonAgregar = document.querySelector(`[data-id="${id}"]`);
            botonAgregar.disabled = false;

            mostrarEventos();
        }

        function limpiarEventos() {
            while (resumen.firstChild) {
                resumen.removeChild(resumen.firstChild);
            }
        }

        // Función asíncronica =====
        async function submitForm(e) {
            e.preventDefault();

            // Obtener el regalo
            const regaloId = document.querySelector('#regalo').value;
            // Iteración sobre el arreglo, con extracción de propiedades
            const eventosId = eventos.map(evento => evento.id);

            if (eventosId.length === 0 || regaloId === '') {
                Swal.fire({
                    'title': 'Error',
                    'text': 'Elige al menos un Evento y un Regalo',
                    'icon': 'error',
                    'confirmButtonText': 'Ok'
                });

                return;
            }

            // Objeto de Formdata
            const datos = new FormData();
            datos.append('eventos', eventosId);
            datos.append('regalo_id', regaloId);

            const url = '/finalizar-registro/conferencias';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });
            const resultado = await respuesta.json();

            if (resultado.resultado) {
                Swal.fire(
                    'Registro Exitoso',
                    'Tus selecciones se han almacenado, te esperamos en DevWebCamp',
                    'success'
                ).then(() => location.href = `/boleto?id=${resultado.token}`)
            } else {
                Swal.fire({
                    'title': 'Error',
                    'text': 'Hubo un Error',
                    'icon': 'error',
                    'confirmButtonText': 'Ok'
                }).then(() => location.reload());
            }

        }
    }
})()