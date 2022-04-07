let paso = 1;

document.addEventListener('DOMContentLoaded', function () {
    mostrarSeccion(); // Llamo la funcion para que por defecto se muestre una seccion al cargar la pagina
    iniciarApp();
    botonesPaginador(); // Agrega o quita los botones del paginador
});


function iniciarApp() {
    tabs(); // Cambia la seccion cuando se presionen los tabs
}


function tabs() {
    const botones = document.querySelectorAll('.tabs button');

    botones.forEach(boton => {
        boton.addEventListener('click', function (e) {
            paso = parseInt(e.target.dataset.paso);
            mostrarSeccion(); // Muestra y oculta las secciones
            botonesPaginador();
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

    //  Quitar la clase de  '.actual' al tab anterior
    const tabAnterior = document.querySelector('.actual');
    if (tabAnterior) {
        tabAnterior.classList.remove('actual');
    }

    // Resalta el tab Actual
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');
}


function botonesPaginador() {
    const paginaAnterior = document.querySelector('#anterior');
    const paginaSiguiente = document.querySelector('#siguiente');

switch (paso) {
    case 1:
        paginaAnterior.classList.add('ocultar');
        paginaSiguiente.classList.remove('ocultar');
        break;
    case 3:
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.add('ocultar');
        break;
    case 2:
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
        break;
    default:
        break;
}

}
