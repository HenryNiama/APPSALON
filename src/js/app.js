let paso = 1;

document.addEventListener('DOMContentLoaded', function () {
    iniciarApp();
});


function iniciarApp() {
    tabs(); // Cambia la seccion cuando se presionen los tabs
}


function tabs() {
    const botones = document.querySelectorAll('.tabs button');

    botones.forEach(boton => {
        boton.addEventListener('click', function (e) {
            paso = parseInt(e.target.dataset.paso);
            mostrarSeccion(paso);
        });
    });

}

function mostrarSeccion(paso) {
    console.log('Mostrando seccion ' + paso);
}