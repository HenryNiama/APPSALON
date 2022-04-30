<h1 class="nombre-pagina">Nuevo Servicio</h1>

<p class="descripcion-pagina">Llena todos los campos para añadir un nuevo Servicio</p>

<?php include_once __DIR__ . '/../templates/barra.php'; ?>
<?php include_once __DIR__ . '/../templates/alertas.php'; ?>

<form action="/servicios/crear" method="POST" class="formulario">
<!-- Voy a agregar el archivo formulario.php aqui. Esto dos archivos comparten solamente campos, pero
NO comparten el action, ni tampoco el input de tipo SUBMIT de este archivo de crear.php -->

    <?php include_once __DIR__ . '/formulario.php'; ?>

    <input type="submit" value="Guardar Nuevo Servicio" class="boton">
</form>