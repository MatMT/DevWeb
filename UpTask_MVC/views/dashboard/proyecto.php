<?php include_once __DIR__  . '/header-dashboard.php' ?>

<div class="contenedor-sm">
    <div class="contenedor-nueva-tarea">
        <button type="button" class="agregar-tarea" id="agregar-tarea"> &#43; Nueva Tarea </button>
    </div>

    <ul id="listado-tareas" class="listado-tareas"></ul>
</div>

<?php include_once __DIR__  . '/footer-dashboard.php' ?>

<?php
$script = '
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="build/js/tareas.js"></script>
    ';
?>