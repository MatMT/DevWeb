    <h4 class="pagina__heading"><?php echo $titulo; ?></h4>
    <p class="pagina__descripcion">Elige hasta 5 eventos para asistir de forma presencial.</p>

    <div class="eventos-registro">
        <main class="eventos-registro__listado">
            <h3 class="eventos-registro__heading--conferencias">&lt;Conferencias /></h3>
            <p class="eventos-registro__fecha">Sábado 25 de Noviembre</p>

            <div class="eventos-registro__grid">
                <?php foreach ($eventos['conferencias_s'] as $evento) { ?>
                    <?php include __DIR__ . '/evento.php' ?>
                <?php }; ?>
            </div>

            <p class="eventos-registro__fecha">Domingo 26 de Noviembre</p>

            <div class="eventos-registro__grid">
                <?php foreach ($eventos['conferencias_d'] as $evento) { ?>
                    <?php include __DIR__ . '/evento.php' ?>
                <?php }; ?>
            </div>

            <h3 class="eventos-registro__heading--workshops">&lt;Workshops /></h3>
            <p class="eventos-registro__fecha">Sábado 25 de Noviembre</p>

            <div class="eventos-registro__grid eventos--workshops">
                <?php foreach ($eventos['workshops_s'] as $evento) { ?>
                    <?php include __DIR__ . '/evento.php' ?>
                <?php }; ?>
            </div>

            <p class="eventos-registro__fecha">Domingo 26 de Noviembre</p>

            <div class="eventos-registro__grid eventos--workshops">
                <?php foreach ($eventos['workshops_d'] as $evento) { ?>
                    <?php include __DIR__ . '/evento.php' ?>
                <?php }; ?>
            </div>
        </main>

        <aside class="registro">
            <h2 class="registro__heading">Tu Regitro</h2>

            <div class="registro__resumen" id="registro-resumen"></div>

            <div class="registro__regalo">
                <label for="regalo" class="registro__label">Selecciona un regalo</label>

                <select id="regalo" class="registro__select">
                    <option value="">-- Selecciona tu regalo --</option>
                    <?php foreach ($regalos as $regalo) { ?>
                        <option value="<?php echo $regalo->id; ?>">
                            <?php echo $regalo->nombre; ?>
                        </option>
                    <?php } ?>
                </select>

                <form action="" class="formulario" id="registro">
                    <div class="formulario__campo">
                        <input type="submit" value="Registrarme" class="formulario__submit formulario__submit--full">
                    </div>
                </form>
            </div>
        </aside>
    </div>