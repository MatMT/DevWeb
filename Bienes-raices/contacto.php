<?php
require 'includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor">
    <h1>Contacto</h1>

    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen contacto">
    </picture>
    <h2>Llene el formulario de contacto</h2>

    <form class="formulario">
        <fieldset>
            <legend>Informacion Personal</legend>

            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Tu nombre" id="nombre"></input>

            <label for="email">E-mail</label>
            <input type="email" placeholder="Tu Email" id="email"></input>

            <label for="telefono">Teléfono</label>
            <input type="tel" placeholder="Tu Teléfono" id="telefono"></input>

            <label for="mensaje">Mensaje</label>
            <textarea id="mensaje"></textarea>
        </fieldset>

        <fieldset>
            <legend>Informacion sobre la propiedad</legend>

            <label for="opciones">Vende o Compra</label>
            <select name="" id="opciones">
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>

            <label for="presupuesto">Precio o presupuesto</label>
            <input type="number" placeholder="Tu precio o presupuesto" id="presupuesto"></input>
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>
            <p>Como desea ser contactado</p>
            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input type="radio" value="telefono" name="contacto" id="contactar-telefono">
                <label for="contactar-email">E-mail</label>
                <input type="radio" value="E-mail" name="contacto" id="contactar-email">
            </div>
            <p>Si elegió teléfono, elija la fecha y la hora</p>

            <label for="fecha">Fecha</label>
            <input type="date" id="fecha"></input>
            <label for="hora">Hora</label>
            <input type="time" id="hora" min="09:00" max="18:00"></input>
        </fieldset>

        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>

<?php
incluirTemplate('footer');
?>