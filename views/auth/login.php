<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia Sesión con tus datos</p>

<form action="/" class="formulario" method="POST">
    <div class="campo">
        <label for="email">Email</label>
        <input 
            type="email"
            id="email"
            placeholder="Tu Email"
            name="email"
        />
    </div>

    <div class="campo">
        <label for="password">Password</label>
        <input 
            type="password"
            id="password"
            placeholder="Tu password"
            name="password"
        />
    </div>

    <input type="submit" value="Iniciar Sesión" class="boton">
</form>


<div class="acciones">
    <a href="/crear-cuenta">¿Aún no tienes una cuenta? ¡Crea una!</a>
    <a href="/forget">¿Olvidaste tu contraseña?</a>
</div>