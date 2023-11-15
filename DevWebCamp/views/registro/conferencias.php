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
        </aside>
    </div>