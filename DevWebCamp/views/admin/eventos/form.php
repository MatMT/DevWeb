<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">
        Información Evento
    </legend>

    <div class="formulario__campo">
        <label class="formulario__label" for="nombre">
            Nombre Evento
        </label>
        <input type="text" class="formulario__input" id="nombre" name="nombre" placeholder="Nombre Evento">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="descripcion">
            Descripción Evento
        </label>
        <textarea class="formulario__input" id="descripcion" name="descripcion" placeholder="Descripcion Evento" rows="8"></textarea>
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="categoria">
            Categoria o Tipo de Evento
        </label>
        <select class="formulario__select" id="categoria" name="categoria_id">
            <option value="" selected disabled>- Seleccionar -</option>
            <?php foreach ($categorias as $categoria) { ?>
                <option value="<?php echo $categoria->id ?>">
                    <?php echo $categoria->nombre; ?>
                </option>
            <?php } ?>
        </select>
    </div>


    <div class="formulario__campo">
        <label class="formulario__label" for="categoria">
            Selecciona el día
        </label>

        <div class="formulario__radio">
            <?php foreach ($dias as $dia) { ?>
                <div>
                    <label for="<?php echo strtolower($dia->nombre) ?>">
                        <?php echo $dia->nombre; ?>
                    </label>

                    <input type="radio" id="<?php echo strtolower($dia->nombre); ?>" name="dia" value="<?php echo $dia->id; ?>">
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="formulario__campo" id="horas">
        <label class="formulario__label" for="categoria">
            Seleccionar Hora
        </label>

        <ul class="horas">
            <?php foreach ($horas as $hora) { ?>
                <li class="horas__hora">
                    <?php echo $hora->hora; ?>
                </li>
            <?php } ?>
        </ul>
    </div>

</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">
        Información Extra
    </legend>

    <div class="formulario__campo">
        <label class="formulario__label" for="ponentes">
            Ponente
        </label>
        <input type="text" class="formulario__input" id="ponentes" placeholder="Buscar Ponente">
    </div>

    <div class="formulario__campo">
        <label class="formulario__label" for="disponibles">
            Lugares Disponibles
        </label>
        <input type="number" min="1" class="formulario__input" id="disponibles" placeholder="Ej. 20">
    </div>

</fieldset>