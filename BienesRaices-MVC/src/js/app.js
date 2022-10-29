document.addEventListener('DOMContentLoaded', function () {
    addEventListener();
    darkmode();
})

function darkmode() {
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    // console.log(prefiereDarkMode.matches);

    if (prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    prefiereDarkMode.addEventListener('change', function () {
        if (prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    })


    const botonDarkmode = document.querySelector('.dark-mode-boton');
    botonDarkmode.addEventListener('click', function () {
        document.body.classList.toggle('dark-mode');
    });
}

function addEventListener() {
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', navegacionResponsive);

    // Muestra campos condicionales - seleccionamos todos los inputs con el name
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto))
}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');

    if (navegacion.classList.contains('mostrar')) {
        navegacion.classList.remove('mostrar');
    } else {
        navegacion.classList.add('mostrar');
    }
}

function mostrarMetodosContacto(e) {
    const contactoDiv = document.querySelector('#contacto');

    if (e.target.value === 'telefono') {
        contactoDiv.innerHTML = `            
        <label for="telefono">Número de Teléfono</label>
        <input type="tel" placeholder="Tu Teléfono" id="telefono" name="contacto[telefono]"></input>
        
        <p>Elija la fecha y la hora para la llamada</p>

        <label for="fecha">Fecha</label>
        <input type="date" id="fecha" name="contacto[fecha]"></input>
        <label for="hora">Hora</label>
        <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]"></input>
        `;
    } else {
        contactoDiv.innerHTML = `
        <label for="email">E-mail</label>
        <input type="email" placeholder="Tu Email" id="email" name="contacto[email]" required></input>
        `;
    }
}