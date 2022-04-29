document.addEventListener('DOMContentLoaded', function () {
    iniciarApp();
});

function iniciarApp() {
    buscarPorFecha();
}

function buscarPorFecha() {
    const fechaInput = document.querySelector('#fecha');

    fechaInput.addEventListener('input', function (e) {
        const fechaSeleccionada = e.target.value;
        // Redireccionamos al usuario: 
        window.location = `?fecha=${fechaSeleccionada}`;
    });
}