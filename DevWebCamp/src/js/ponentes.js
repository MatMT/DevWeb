(function () {
    const ponentesInput = document.querySelector('#ponentes');

    if (ponentesInput) {
        let ponentes = [];
        let ponentesFiltrados = [];

        const listadoPonetes = document.querySelector('#listado-ponentes');
        const ponenteHidden = document.querySelector('[name="ponente_id"]');

        obtenerPonentes();
        ponentesInput.addEventListener('input', buscarPonentes);

        if (ponenteHidden.value) {
            (async () => {
                const ponente = await obtenerPonente(ponenteHidden.value);
                // Insertar en el DOM
                const ponenteDOM = document.createElement('LI');
                ponenteDOM.classList.add('listado-ponentes__ponente', 'listado-ponentes__ponente--selected');
                ponenteDOM.textContent = `${ponente.nombre.trim()} ${ponente.apellido.trim()}`;


                listadoPonetes.appendChild(ponenteDOM);
            })()
        }

        async function obtenerPonentes() {
            const url = `/api/ponentes`;

            const respuesta = await fetch(url);
            const resultado = await respuesta.json();

            formatearPonentes(resultado);
        };

        async function obtenerPonente(id) {
            const url = `/api/ponente?id=${id}`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();
            return resultado;
        }

        function formatearPonentes(arrayPonentes = []) {
            // Retorna un Arrelgo de objetos formateados
            ponentes = arrayPonentes.map(ponente => {
                return {
                    nombre: `${ponente.nombre.trim()} ${ponente.apellido.trim()}`,
                    id: ponente.id
                }
            })
        }

        function buscarPonentes(e) {
            const busqueda = e.target.value;

            if (busqueda.length > 3) {
                // Bandera, ignora upper/lower case
                const expresion = new RegExp(busqueda, "i");
                ponentesFiltrados = ponentes.filter(ponente => {
                    if (ponente.nombre.toLowerCase().search(expresion) != -1) {
                        return ponente;
                    }
                })
            } else {
                ponentesFiltrados = [];
            }

            mostrarPonentes();
        }

        function mostrarPonentes() {
            while (listadoPonetes.firstChild) {
                listadoPonetes.removeChild(listadoPonetes.firstChild);
            }

            if (ponentesFiltrados.length > 0) {
                ponentesFiltrados.forEach(ponente => {
                    const ponenteHTML = document.createElement('LI');
                    ponenteHTML.classList.add('listado-ponentes__ponente');
                    ponenteHTML.textContent = ponente.nombre;
                    ponenteHTML.dataset.ponenteId = ponente.id;
                    ponenteHTML.onclick = seleccionarPonente;

                    // Añadir al DOM
                    listadoPonetes.appendChild(ponenteHTML);
                })
            } else {
                const noResultados = document.createElement('P');
                noResultados.classList.add('listado-ponentes__no-resultados');
                noResultados.textContent = "No hay resultados para tu búsqueda";

                // Añadir al DOM 
                listadoPonetes.appendChild(noResultados);
            }
        }

        function seleccionarPonente(e) {
            const ponente = e.target;

            // Remover ponente anterior
            const ponenteAnterior = document.querySelector('.listado-ponentes__ponente--selected');

            if (ponenteAnterior) {
                ponenteAnterior.classList.remove('listado-ponentes__ponente--selected');
            }

            ponente.classList.add('listado-ponentes__ponente--selected');
            ponenteHidden.value = ponente.dataset.ponenteId;
        }
    }
})();