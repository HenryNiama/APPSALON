<h1 class="nombre-pagina">Actualizar Servicio</h1>

<p class="descripcion-pagina">Modificar los valores del formulario</p>

<?php include_once __DIR__ . '/../templates/barra.php'; ?>
<?php include_once __DIR__ . '/../templates/alertas.php'; ?>

<!--Eliminamos el action del Form para que se envie a este mismo archivo /servicios/actualizar y
asi no pierde la referencia. -->

<form method="POST" class="formulario">
<!-- Voy a agregar el archivo formulario.php aqui. Esto dos archivos comparten solamente campos, pero
NO comparten el action, ni tampoco el input de tipo SUBMIT de este archivo de crear.php -->

    <?php include_once __DIR__ . '/formulario.php'; ?>

    <input type="submit" value="Actualizar" class="boton">
</form>