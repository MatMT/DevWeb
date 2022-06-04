<?php
// Importar la base de datos
require __DIR__ . '/../config/database.php';
$db = conectarDB();
// Consultar
$query = "SELECT * FROM propiedades LIMIT ${limite} ";

// Iterar en los resultados
$resulatado = mysqli_query($db, $query);

?>

<div class="contenedor-anuncios">
    <?php while ($propiedad = mysqli_fetch_assoc($resulatado)) : ?>
        <div class="anuncio">
            <img loading="lazy" src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="anuncio">

            <div class="contenido-anuncio">
                <h3><?php echo $propiedad['titulo']; ?></h3>
                <p><?php echo $propiedad['descripcion']; ?></p>
                <p class="precio">$<?php echo $propiedad['precio']; ?></p>

                <ul class="iconos-caracteristicas">
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                        <p><?php echo $propiedad['wc']; ?></p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                        <p><?php echo $propiedad['estacionamiento']; ?></p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                        <p><?php echo $propiedad['habitaciones']; ?></p>
                    </li>
                </ul>

                <a href="anuncio.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">Ver propiedad</a>
            </div>
            <!--.contenido-anuncio-->
        </div>
        <!--.anuncio-->
    <?php endwhile; ?>
</div>

<?php
// Cerrar la conexión
mysqli_close($db);
?>