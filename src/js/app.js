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
            mostrarSeccion();
        });
    });

}

function mostrarSeccion() {

    // Ocultar la seccion que tenga la clase de mostrar
    const seccionAnterior = document.querySelector('.mostrar');
    
    if (seccionAnterior) { // Si existe alguna seccion que tenga la clase .mostrar, entonces:
        seccionAnterior.classList.remove('mostrar');  
    }


    // Seleccionar la seccion con el paso:
    const pasoSelector = `#paso-${paso}`; // Esta como paso-# en cada div.
    const seccion = document.querySelector(pasoSelector);
    seccion.classList.add('mostrar');

}