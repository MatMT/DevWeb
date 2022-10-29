<main class="contenedor">
    <h1>Contacto</h1>

    <?php
    if ($mensaje) { ?>
        <p class="alerta exito"> <?php echo $mensaje; ?> </p>
    <?php
    }
    ?>

    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen contacto">
    </picture>
    <h2>Llene el formulario de contacto</h2>

    <form class="formulario" action="/contacto" method="POST" novalidate>
        <fieldset>
            <legend>Informacion Personal</legend>

            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Tu nombre" id="nombre" name="contacto[nombre]" required></input>

            <label for="mensaje">Mensaje</label>
            <textarea id="mensaje" name="contacto[mensaje]" required></textarea>
        </fieldset>

        <fieldset>
            <legend>Informacion sobre la propiedad</legend>

            <label for="opciones">Vende o Compra</label>
            <select name="contacto[tipo]" id="opciones" required>
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>

            <label for="presupuesto">Precio o presupuesto</label>
            <input type="number" placeholder="Tu precio o presupuesto" id="presupuesto" name="contacto[precio]" required></input>
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>
            <p>Como desea ser contactado</p>
            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input type="radio" value="telefono" name="contacto[contacto]" id="contactar-telefono" required>
                <label for="contactar-email">E-mail</label>
                <input type="radio" value="E-mail" name="contacto[contacto]" id="contactar-email" required>
            </div>

            <div id="contacto">

            </div>
        </fieldset>

        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>