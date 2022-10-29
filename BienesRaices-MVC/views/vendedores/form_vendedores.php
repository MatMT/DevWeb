<fieldset>
    <legend>Información General</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre Vendedor" value="<?php echo s($vendedor->nombre); ?>">

    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellido Vendedor" value="<?php echo s($vendedor->apellido); ?>">


</fieldset>

<fieldset>
    <legend>Inrformación Extra</legend>
    <label for="telefono">Teléfono:</label>
    <input type="text" id="telefono" name="vendedor[telefono]" placeholder="Telefono Vendedor" value="<?php echo s($vendedor->telefono); ?>">
</fieldset>