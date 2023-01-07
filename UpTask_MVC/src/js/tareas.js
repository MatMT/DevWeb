(function () {
    obtenerTareas();
    let tareas = [];

    // Botón para Modal Agregar Tarea
    const nuevaTareaBtn = document.querySelector('#agregar-tarea');
    nuevaTareaBtn.addEventListener('click', mostrarFormulario);

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

        if (tareas.length < 1) {
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

        tareas.forEach(tarea => {
            // Contenedor de tarea
            const contenedorTarea = document.createElement('LI');
            contenedorTarea.dataset.tareaId = tarea.id;
            contenedorTarea.classList.add('tarea');

            // Contenido - información de la tarea
            const nombreTarea = document.createElement('P');
            nombreTarea.textContent = tarea.nombre;

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

    function mostrarFormulario() {
        const modal = document.createElement('DIV');
        modal.classList.add('modal');
        modal.innerHTML = `
            <form class="formulario nueva-tarea">
                <legend>Añade una nueva tarea</legend>
                <div class="campo">
                    <label>Tarea</label>
                    <input
                        type="text"
                        name="tarea"
                        placeholder="Añadir Tarea al Proyecto Actual"
                        id="tarea"
                    />
                </div>
                <div class="opciones">
                    <input
                        type="submit"
                        class="submit-nueva-tarea"
                        value="Añadir Tarea"
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
                submitFormularioNuevaTarea();
            }
        })

        document.querySelector('.dashboard').appendChild(modal);
    }

    function submitFormularioNuevaTarea() {
        // Extraer value
        const tarea = document.querySelector('#tarea').value.trim();

        if (!tarea) {
            // Tarea vacía
            mostrarAlerta('El Nombre de la tarea es Obligatorio', 'error', document.querySelector('.formulario legend'));
            return;
        }
        agregarTarea(tarea);
    };

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
                mostrarAlerta(
                    resultado.respuesta.mensaje,
                    'exito',
                    document.querySelector('.contenedor-nueva-tarea'));
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