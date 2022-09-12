<?php
require 'includes/app.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Conoce sobre Nosotros</h1>

    <div class="contenido-nosotros">
        <div class="imagen">
            <picture>
                <source srcset="build/img/nosotros.webp" type="image/webp">
                <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre nosotros">
            </picture>
        </div>

        <div class="texto-nosotros">
            <blockquote>
                25 años de experiencia
            </blockquote>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos iusto neque, doloremque eum laborum architecto explicabo? Cumque beatae in architecto. Ea similique veritatis rem commodi expedita laborum et laboriosam cum?Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia doloribus minus voluptates facere, placeat quos quibusdam culpa ipsum reprehenderit numquam laboriosam ut aliquid recusandae! Exercitationem saepe illo neque ullam alias?</p>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Error quo vel fuga veniam ipsa, labore ex perferendis soluta quam laudantium officia ut a ea aliquam placeat! Placeat officia sit adipisci.</p>
        </div>
    </div>
</main>

<section class="contenedor seccion">
    <h1>Más Sobre Nosotros</h1>

    <div class="iconos-nosotros">
        <div class="icono">
            <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
            <h3>Seguridad</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cupiditate praesentium cumque.</p>
        </div>
        <div class="icono">
            <img src="build/img/icono2.svg" alt="Icono precio" loading="lazy">
            <h3>Precio</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cupiditate praesentium cumque..</p>
        </div>
        <div class="icono">
            <img src="build/img/icono3.svg" alt="Icono tiempo" loading="lazy">
            <h3>A tiempo</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cupiditate praesentium cumque.</p>
        </div>
    </div>
</section>

<?php
incluirTemplate('footer');
?>