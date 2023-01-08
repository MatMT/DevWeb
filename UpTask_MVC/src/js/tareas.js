(function () {
    obtenerTareas();
    let tareas = [];
    let filtradas = [];

    // Botón para Modal Agregar Tarea
    const nuevaTareaBtn = document.querySelector('#agregar-tarea');
    nuevaTareaBtn.addEventListener('click', function () {
        mostrarFormulario()
    }
    );

    // Filtros de búsqueda
    const filtros = document.querySelectorAll('#filtros input[type="radio"]');
    filtros.forEach(radio => {
        radio.addEventListener('input', filtrarTareas);
    });

    function filtrarTareas(e) {
        const filtro = e.target.value;

        if (filtro !== '') {
            // Iterando sobre el objeto en memoria
            filtradas = tareas.filter(tarea => tarea.estado === filtro);
        } else {
            filtradas = [];
        }

        mostrarTareas();
    }

    async function obtenerTareas() {
        try {
            const id = obtenerProyecto();
            const url = `/api/tareas?id=${id}`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();

            // Guardamos en la variable global
            tareas = resultado.tareas;
            mostrarTareas();
        } catch (error) {
            console.log(error);
        }
    }
    function mostrarTareas() {
        limpiarTareas();

        const arrayTareas = filtradas.length ? filtradas : tareas;

        if (arrayTareas.length < 1) {
            const contenedorTareas = document.querySelector('.listado-tareas');
            const textoNotareas = document.createElement('LI');
            textoNotareas.textContent = 'Aún no hay tareas agregadas';
            textoNotareas.classList.add('no-tareas');
            contenedorTareas.appendChild(textoNotareas);
            return;
        }

        const estados = {
            0: 'Pendiente',
            1: 'Completa'
        }

        arrayTareas.forEach(tarea => {
            // Contenedor de tarea
            const contenedorTarea = document.createElement('LI');
            contenedorTarea.dataset.tareaId = tarea.id;
            contenedorTarea.classList.add('tarea');

            // Contenido - información de la tarea
            const nombreTarea = document.createElement('P');
            nombreTarea.textContent = tarea.nombre;
            nombreTarea.ondblclick = function () {
                mostrarFormulario(true, { ...tarea });
            }

            // Contenedor de opciones
            const opcionesDiv = document.createElement('DIV');
            opcionesDiv.classList.add('opciones');

            // Boton de completar
            const btnEstadoTarea = document.createElement('BUTTON');
            btnEstadoTarea.classList.add('estado-tarea');
            btnEstadoTarea.classList.add(`${estados[tarea.estado].toLowerCase()}`);
            btnEstadoTarea.textContent = estados[tarea.estado];
            btnEstadoTarea.dataset.estadoTarea = tarea.estado;

            // Copia de arreglo a modificar
            btnEstadoTarea.ondblclick = function () {
                cambiarEstadoTarea({ ...tarea });
            };

            // Boton de eliminar
            const btnEliminarTarea = document.createElement('BUTTON');
            btnEliminarTarea.classList.add('eliminar-tarea');
            btnEliminarTarea.dataset.idTarea = tarea.id;
            btnEliminarTarea.textContent = 'Eliminar';
            btnEliminarTarea.onclick = function () {
                confirmarEliminarTarea({ ...tarea });
            }

            // Armando contenedor de opciones
            opcionesDiv.appendChild(btnEstadoTarea);
            opcionesDiv.appendChild(btnEliminarTarea);

            // Armando contenedor de tarea y opciones
            contenedorTarea.appendChild(nombreTarea);
            contenedorTarea.appendChild(opcionesDiv);

            // Agregando tareas al Div Padre
            const listadoTareas = document.querySelector('.listado-tareas');
            listadoTareas.appendChild(contenedorTarea);

        });
    }

    function mostrarFormulario(editar = false, tarea = {}) {
        const modal = document.createElement('DIV');
        modal.classList.add('modal');
        modal.innerHTML = `
            <form class="formulario nueva-tarea">
                <legend>${editar ? 'Edita el nombre de la tarea' : 'Añade una nueva tarea'}</legend>
                <div class="campo">
                    <label>Tarea</label>
                    <input
                        type="text"
                        name="tarea"
                        placeholder="${editar ? 'Editar Tarea del' : 'Añadir Tarea al'} Proyecto Actual"
                        id="tarea"
                        value="${tarea.nombre ? tarea.nombre : ''}"
                    />
                </div>
                <div class="opciones">
                    <input
                        type="submit"
                        class="submit-nueva-tarea"
                        value="${editar ? 'Guardar cambios' : 'Añadir Tarea'}"
                    />
                    <button type="button" class="cerrar-modal">Cancelar</button>
                </div>
            </form>
        `;

        setTimeout(() => {
            const formulario = document.querySelector('.formulario');
            formulario.classList.add('animar');
        }, 200);

        modal.addEventListener('click', function (e) {
            e.preventDefault();
            if (e.target.classList.contains('cerrar-modal')) {
                const formulario = document.querySelector('.formulario');
                formulario.classList.add('cerrar');
                setTimeout(() => {
                    modal.remove();
                }, 600);
            }

            if (e.target.classList.contains('submit-nueva-tarea')) {
                // Extraer value
                const nombreTarea = document.querySelector('#tarea').value.trim();

                if (!nombreTarea) {
                    // Tarea vacía
                    mostrarAlerta('El Nombre de la tarea es Obligatorio', 'error', document.querySelector('.formulario legend'));
                    return;
                }

                if (editar) {
                    // Asignamos nuevo nombre de la tarea
                    tarea.nombre = nombreTarea;
                    // Enviamos a la petición
                    actualizarTarea(tarea);
                } else {
                    agregarTarea(nombreTarea);
                }


            }
        })

        document.querySelector('.dashboard').appendChild(modal);
    }


    // Cambiar estado de Tarea
    function cambiarEstadoTarea(tarea) {
        // Si está como 1 cambiar a 0, e inversa
        const NuevoEstado = tarea.estado === "1" ? "0" : "1";
        // Reasignar valor
        tarea.estado = NuevoEstado;

        actualizarTarea(tarea);
    }

    // Enviando al backend
    async function actualizarTarea(tarea) {
        const { estado, id, nombre } = tarea;

        // Creación de la petición
        const datos = new FormData();
        datos.append('id', id);
        datos.append('nombre', nombre);
        datos.append('estado', estado);
        datos.append('proyectoId', obtenerProyecto());

        try {
            const url = 'http://localhost:3000/api/tarea/actualizar';

            // Conexión a la URL
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });

            const resultado = await respuesta.json();
            if (resultado.respuesta.tipo === 'exito') {
                Swal.fire(
                    resultado.respuesta.mensaje,
                    resultado.respuesta.mensaje,
                    'success'
                );
            }

            const modal = document.querySelector('.modal');
            if (modal) {
                modal.remove();

            }

            tareas = tareas.map(tareaMemoria => {
                if (tareaMemoria.id === id) {
                    tareaMemoria.estado = estado;
                    tareaMemoria.nombre = nombre;
                }
                return tareaMemoria;
            });

            mostrarTareas();
        } catch (error) {
            console.log(error);
        }
    }

    // Confirmar Eliminar tarea
    function confirmarEliminarTarea(tarea) {
        Swal.fire({
            title: '¿Eliminar Tarea?',
            showCancelButton: true,
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                eliminarTarea(tarea)
            }
        })
    }

    async function eliminarTarea(tarea) {
        const { estado, id, nombre } = tarea;

        // Creación de la petición
        const datos = new FormData();
        datos.append('id', id);
        datos.append('nombre', nombre);
        datos.append('estado', estado);
        datos.append('proyectoId', obtenerProyecto());

        try {
            // Conexión a la URL
            const url = 'http://localhost:3000/api/tarea/eliminar';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });

            const resultado = await respuesta.json();

            if (resultado.resultado === true) {
                Swal.fire('¡Eliminado!', resultado.mensaje, 'success');

                // Retorna todas las que tengan un id diferente al mío
                tareas = tareas.filter(tareaMemoria => tareaMemoria.id !== tarea.id);
                mostrarTareas();
            }

        } catch (error) {
            console.log(error);
        }
    }

    // Muestra un mensaje en la interfaz
    function mostrarAlerta(mensaje, tipo, referencia) {
        // Previene la creación de multiples alertas
        const alertaPrevia = document.querySelector('.alerta');
        if (alertaPrevia) {
            alertaPrevia.remove();
        }

        const alerta = document.createElement('DIV');
        // Agregamos la clase de la alerta
        alerta.classList.add('alerta', tipo)

        // Agregamos el mensaje
        alerta.textContent = mensaje;

        // Insertar antes del legend
        referencia.parentElement.insertBefore(alerta, referencia.nextElementSibling);

        // Eliminar la alerta después de 5 segundos
        setTimeout(() => {
            alerta.remove();
        }, 4500);
    };

    // Consultar el servidor para agregar la tarea
    async function agregarTarea(tarea) {
        // Construir la petición
        const datos = new FormData();

        datos.append('nombre', tarea);
        datos.append('proyectoId', obtenerProyecto());

        try {
            const url = 'http://localhost:3000/api/tarea';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });

            const resultado = await respuesta.json();
            // Conexión correcta - respuesta de error
            mostrarAlerta(resultado.mensaje, resultado.tipo, document.querySelector('.formulario legend'));

            if (resultado.tipo === 'exito') {
                const modal = document.querySelector('.modal');
                setTimeout(() => {
                    modal.remove();
                }, 1500);

                // Crear el objeto de tarea con el mismo formato en BD
                const tareaObj = {
                    id: String(resultado.id),
                    nombre: tarea,
                    estado: "0",
                    proyectoId: resultado.proyectoId
                }

                // Agregar la copia en memoria
                tareas = [...tareas, tareaObj];
                mostrarTareas();
            }

        } catch (error) { // Petición con URL mal hecha o datos no enviados
            console.log(error);
        }
    }

    function obtenerProyecto() {
        // Lee la URL
        const proyectoParams = new URLSearchParams(window.location.search);

        // Encuentra los parametos
        const proyecto = Object.fromEntries(proyectoParams.entries());

        // Retorna el campo de la URL
        return proyecto.id;
    }

    function limpiarTareas() {
        const listadoTareas = document.querySelector('.listado-tareas');

        // Mientras tenga un hijo los elimina
        while (listadoTareas.firstChild) {
            listadoTareas.removeChild(listadoTareas.firstChild);
        }
    }

})();