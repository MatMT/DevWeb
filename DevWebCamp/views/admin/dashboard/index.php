<h1 class="dashboard__heading"><?php echo $titulo; ?></h1>

<main class="bloques">
    <div class="bloques__grid">
        <div class="bloque">
            <h3 class="bloque__heading">Últimos Registros</h3>
            <?php foreach ($registros as $registro) { ?>
                <div class="bloque__contenido">
                    <p class="bloque__texto">
                        <?php echo $registro->usuario->nombre . " " . $registro->usuario->apellido; ?>
                    </p>
                </div>
            <?php } ?>
        </div>

        <div class="bloque">
            <h3 class="bloque__heading">Ganancia neta</h3>
            <div class="bloque__contenido">
                <p class="bloque__texto--cantidad">
                    <?php echo "$ " . $ingresos; ?>
                </p>
            </div>
        </div>

        <div class="bloque">
            <h3 class="bloque__heading">Eventos con Menos Lugares Disponibles</h3>
            <div class="bloque__contenido">
                <p class="bloque__texto--cantidad">
                    <?php foreach ($minus_disp as $evento) { ?>
                <p class="bloque__texto">
                    <?php echo $evento->nombre . " | " . $evento->disponibles . " Disponibles"; ?>
                </p>
            <?php } ?>
            </p>
            </div>
        </div>

        <div class="bloque">
            <h3 class="bloque__heading">Eventos con Más Lugares Disponibles</h3>
            <div class="bloque__contenido">
                <p class="bloque__texto--cantidad">
                    <?php foreach ($more_disp as $evento) { ?>
                <p class="bloque__texto">
                    <?php echo $evento->nombre . " - " . $evento->disponibles . " Disponibles"; ?>
                </p>
            <?php } ?>
            </p>
            </div>
        </div>
    </div>
</main>