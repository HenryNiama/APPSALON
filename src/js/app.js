//---------------- VARIABLES ----------------------------------

let paso = 1;

const pasoInicial = 1; // Valor inicial de primer paginador o dato.
const pasoFinal = 3; // Valor final del ultimo paginador o dato.

const cita = {
    nombre : '',
    fecha: '',
    hora: '',
    servicios: []
};

// ---------------- EVENTOS ------------------------------------
document.addEventListener('DOMContentLoaded', function () {
    mostrarSeccion(); // Llamo la funcion para que por defecto se muestre una seccion al cargar la pagina
    iniciarApp();
    botonesPaginador(); // Agrega o quita los botones del paginador
    paginaSiguiente();
    paginaAnterior();

    consultarAPI(); // Consulta la API en el backend de PHP

    nombreCliente(); // Anade el nombre del cliente al objeto de cita.
    seleccionarFecha(); // Anade la fecha de la cita en el objeto.
    seleccionarHora(); // Anade la hora de la cita en el objeto.
});


// ------------------ FUNCIONES -----------------------------------

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

    mostrarSeccion();

}


function paginaAnterior() {
    const paginaAnterior = document.querySelector('#anterior');

    paginaAnterior.addEventListener('click', function () {
        if ( paso <= pasoInicial )  return; // Si es igual al pasoInicial, entonces se queda hasta ahi.

        paso--;

        botonesPaginador();
    });

}

function paginaSiguiente() {
    const paginaSiguiente = document.querySelector('#siguiente');

        paginaSiguiente.addEventListener('click', function () {
        if (paso >= pasoFinal )  return; // Si es igual al pasoInicial, entonces se queda hasta ahi.

        paso++;

        botonesPaginador();
    });
}

// Con esta funcion asincrona, puede arrancarse, y ejecutarse tambien otras funciones
async function consultarAPI() {
    try {
        // URL que voy a consumir, la que tiene mi API:
        const url = 'http://localhost:3000/api/servicios';

        // Async y Await van de la mano, se usan al mismo tiempo y obligatoriamente para que funcione.
        // El Await espera que se cargen todos mis registros, puede que sean 10K o m[as y este espera hasta que esten todos.
        const resultado = await fetch(url); // Fetch va a consumir este servicio.

        const servicios = await resultado.json(); // Devuelve un array en JS de todos los servicios de la BD.

        mostrarServicios(servicios);
    } catch (error) {
        
    }
}

function mostrarServicios(servicios) {
    servicios.forEach(servicio => {
        const{id, nombre, precio} = servicio;

        const nombreServicio = document.createElement('P');
        nombreServicio.classList.add('nombre-servicio');
        nombreServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.classList.add('precio-servicio');
        precioServicio.textContent = `$ ${precio}`;

        const servicioDiv = document.createElement('DIV');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = id;
        servicioDiv.onclick = function () {
            seleccionarServicio(servicio);
        };

        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);

        // Agrego mi nuevo div al div de paso-1 con id de servicios que esta en el index de cita.
        document.querySelector('#servicios').appendChild(servicioDiv);
    });
}

function seleccionarServicio(servicio) {
    
    const {id} = servicio;
    const {servicios} = cita;// Extraigo la propiedad de 'servicios' del objeto de cita que cree arriba en variables

    // Identificar al elemento que se le da click.
    const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);

    // Comprobar si un servicio ya fue agregado
    if (servicios.some(agregado => agregado.id === id)) {// Compara entre el arreglo y el objeto de servicio seleccionado.
        // Si ya esta agregado, vamos a eliminarlo del array de servicios del objeto de citas:
        cita.servicios = servicios.filter(agregado => agregado.id !== id);
        divServicio.classList.remove('seleccionado');
    }else{
        // Si no esta agregado, lo agregaremos.
        cita.servicios = [...servicios, servicio];
        divServicio.classList.add('seleccionado');
    }

    console.log(cita);

}

function nombreCliente() {
    cita.nombre = document.querySelector('#nombre').value;
}

function seleccionarFecha() {
    const inputFecha = document.querySelector('#fecha');

    inputFecha.addEventListener('input', function (e) {
        const dia = new Date(e.target.value).getUTCDay();// Me devuelve un entero del numero del dia. Domingo es 0

        if ([6,0].includes(dia)) {
            e.target.value = '';
            mostrarAlerta('Fines de Semana no Permitidos', 'error');
        }else{ // Si es cualquier otro dia:
            cita.fecha = e.target.value();// Guardamos la fecha escogida en el objeto
        }
    });
}

function seleccionarHora() {

    const inputHora = document.querySelector('#hora');

    inputHora.addEventListener('input', function (e) {
        const horaCita = e.target.value; // Recupera la hora.
        const hora = horaCita.split(":"); // Separa una cadena de texto, en los :, devuelve un array.

        if (hora < 10 || hora > 18) {
            mostrarAlerta('Hora no Válida', 'error');
        }else{
            cita.hora = e.target.value();
        }       
    });
}


function mostrarAlerta(mensaje, tipo) {

    // Previene que se genere mas de 1 alerta:
    const alertaPrevia = document.querySelector('.alerta');
    if(alertaPrevia) return; // Si ya existe una alerta previa, se sale, asi ya no crea mas.

    // Creacion de alerta:
    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add('alerta');
    alerta.classList.add(tipo);

    const formulario = document.querySelector('.formulario');
    formulario.appendChild(alerta);

    // Eliminacion de alerta:
    setTimeout(() => {
        alerta.remove();
    }, 3000);
}

