let paso=1;function iniciarApp(){tabs()}function tabs(){document.querySelectorAll(".tabs button").forEach(t=>{t.addEventListener("click",(function(t){paso=parseInt(t.target.dataset.paso),mostrarSeccion()}))})}function mostrarSeccion(){const t=document.querySelector(".mostrar");t&&t.classList.remove("mostrar");const o="#paso-"+paso;document.querySelector(o).classList.add("mostrar");const a=document.querySelector(".actual");a&&a.classList.remove("actual");document.querySelector(`[data-paso="${paso}"]`).classList.add("actual")}document.addEventListener("DOMContentLoaded",(function(){mostrarSeccion(),iniciarApp()}));