<h1 class="nombre-pagina">Crear Cuenta</h1>

<p class="descripcion-pagina">Llena el siguiente formulario para crear una cuenta</p>

<form action="/crear-cuenta" class="formulario" method="POST">

    <div class="campo">
        <label for="nombre">Nombre:</label>
        <input 
            type="text"
            id="nombre"
            name="nombre"
            placeholder="Tu Nombre"
        />
    </div>

    <div class="campo">
        <label for="apellido">Apellido:</label>
        <input 
            type="text"
            id="apellido"
            name="apellido"
            placeholder="Tu Apellido"
        />
    </div>

    <div class="campo">
        <label for="telefono">Celular ✆:</label>
        <input 
            type="tel"
            id="telefono"
            name="telefono"
            placeholder="Tu Celular"
        />
    </div>

    <div class="campo">
        <label for="email">E-mail:</label>
        <input 
            type="email"
            id="email"
            name="email"
            placeholder="Tu E-mail"
        />
    </div>

    <div class="campo">
        <label for="password">Password:</label>
        <input 
            type="password"
            id="password"
            name="password"
            placeholder="Escribe una contraseña"
        />
    </div>

    <input type="submit" value="Crear Cuenta" class="boton">

</form>


<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? ¡Inicia Sesión!</a>
    <a href="/forget">¿Olvidaste tu contraseña?</a>
</div>