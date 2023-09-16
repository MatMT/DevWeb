const mobileMenuBtn = document.querySelector('#mobile-menu');
const cerrarMenuBtn = document.querySelector('#cerrar-menu');
const sidebar = document.querySelector('.sidebar');

if (mobileMenuBtn) {
    mobileMenuBtn.addEventListener('click', function () {
        sidebar.classList.toggle('mostrar');
    });
}

if (cerrarMenuBtn) {
    cerrarMenuBtn.addEventListener('click', function () {
        sidebar.classList.add('ocultar');
        setTimeout(() => {
            sidebar.classList.remove('mostrar');
            sidebar.classList.remove('ocultar');
        }, 1000);
    })
}

// Elimina la clase de mostrar, en tamaño de talet y mayores
const anchoScreen = document.body.clientWidth;
window.addEventListener('resize', function () {
    if (anchoScreen >= 768) {
        sidebar.classList.remove('mostrar');
    }
})