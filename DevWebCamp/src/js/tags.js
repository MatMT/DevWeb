(function () {
    const tagsInput = document.querySelector('#tags_input');

    if (tagsInput) {
        const tagsDiv = document.querySelector('#tags');
        const tagsInputHidden = document.querySelector('[name="tags"]');

        let tags = [];

        // Recuperar del input oculto
        if (tagsInputHidden.value !== '') {
            tags = tagsInputHidden.value.split(',');
            mostrarTags();
        }

        // Escuchar los cambios en el input
        tagsInput.addEventListener('keypress', guardarTag);

        function guardarTag(e) {
            if (e.keyCode == 44) {
                e.preventDefault();

                if (e.target.value.trim() === '' || e.target.value.length < 1) {
                    return;
                }

                tags = [...tags, e.target.value.trim()];
                tagsInput.value = '';

                mostrarTags();
            }
        }


        function mostrarTags() { // ==== DOM SCRIPTING ====
            tagsDiv.textContent = "";

            tags.forEach(tag => {
                const etiqueta = document.createElement('LI');
                etiqueta.classList.add('formulario__tag');
                etiqueta.textContent = tag;

                // Función disponible por Scripting
                etiqueta.ondblclick = eliminarTag;

                tagsDiv.appendChild(etiqueta);
            });

            actualizarInputHidden();
        }

        function actualizarInputHidden() {
            // Convertir el arreglo en String
            tagsInputHidden.value = tags.toString();
        }

        function eliminarTag(e) {
            // Se elimina del DOM
            e.target.remove();

            // Se elimina del arreglo
            tags = tags.filter(tag => tag !== e.target.textContent);
            actualizarInputHidden();
        }
    }
}())