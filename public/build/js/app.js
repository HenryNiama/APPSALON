let paso=1;const pasoInicial=1,pasoFinal=3,cita={nombre:"",fecha:"",hora:"",servicios:[]};function iniciarApp(){tabs()}function tabs(){document.querySelectorAll(".tabs button").forEach(e=>{e.addEventListener("click",(function(e){e.preventDefault(),paso=parseInt(e.target.dataset.paso),mostrarSeccion(),botonesPaginador()}))})}function mostrarSeccion(){const e=document.querySelector(".mostrar");e&&e.classList.remove("mostrar");const t="#paso-"+paso;document.querySelector(t).classList.add("mostrar");const o=document.querySelector(".actual");o&&o.classList.remove("actual");document.querySelector(`[data-paso="${paso}"]`).classList.add("actual")}function botonesPaginador(){const e=document.querySelector("#anterior"),t=document.querySelector("#siguiente");switch(paso){case 1:e.classList.add("ocultar"),t.classList.remove("ocultar");break;case 3:e.classList.remove("ocultar"),t.classList.add("ocultar"),mostrarResumen();break;case 2:e.classList.remove("ocultar"),t.classList.remove("ocultar")}mostrarSeccion()}function paginaAnterior(){document.querySelector("#anterior").addEventListener("click",(function(){paso<=1||(paso--,botonesPaginador())}))}function paginaSiguiente(){document.querySelector("#siguiente").addEventListener("click",(function(){paso>=3||(paso++,botonesPaginador())}))}async function consultarAPI(){try{const e="http://localhost:3000/api/servicios",t=await fetch(e);mostrarServicios(await t.json())}catch(e){}}function mostrarServicios(e){e.forEach(e=>{const{id:t,nombre:o,precio:a}=e,c=document.createElement("P");c.classList.add("nombre-servicio"),c.textContent=o;const n=document.createElement("P");n.classList.add("precio-servicio"),n.textContent="$ "+a;const r=document.createElement("DIV");r.classList.add("servicio"),r.dataset.idServicio=t,r.onclick=function(){seleccionarServicio(e)},r.appendChild(c),r.appendChild(n),document.querySelector("#servicios").appendChild(r)})}function seleccionarServicio(e){const{id:t}=e,{servicios:o}=cita,a=document.querySelector(`[data-id-servicio="${t}"]`);o.some(e=>e.id===t)?(cita.servicios=o.filter(e=>e.id!==t),a.classList.remove("seleccionado")):(cita.servicios=[...o,e],a.classList.add("seleccionado")),console.log(cita)}function nombreCliente(){cita.nombre=document.querySelector("#nombre").value}function seleccionarFecha(){document.querySelector("#fecha").addEventListener("input",(function(e){const t=new Date(e.target.value).getUTCDay();[6,0].includes(t)?(e.target.value="",mostrarAlerta("Fines de Semana no Permitidos","error")):cita.fecha=e.target.value}))}function seleccionarHora(){document.querySelector("#hora").addEventListener("input",(function(e){const t=e.target.value.split(":");t[0]<10||t[0]>18?mostrarAlerta("Hora no Válida","error"):cita.hora=e.target.value}))}function mostrarAlerta(e,t){if(document.querySelector(".alerta"))return;const o=document.createElement("DIV");o.textContent=e,o.classList.add("alerta"),o.classList.add(t);document.querySelector(".formulario").appendChild(o),setTimeout(()=>{o.remove()},3e3)}function mostrarResumen(){document.querySelector(".contenido-resumen");Object.values(cita).includes("")?console.log("Hace falta datos XD"):console.log("Todo Bien")}document.addEventListener("DOMContentLoaded",(function(){mostrarSeccion(),iniciarApp(),botonesPaginador(),paginaSiguiente(),paginaAnterior(),consultarAPI(),nombreCliente(),seleccionarFecha(),seleccionarHora(),mostrarResumen()}));