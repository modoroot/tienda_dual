//Toggle
//Constantes toggle titles
const toggleDescripcion = document.querySelector('.titulo-description');
const toggleInfo = document.querySelector('.titulo-info');
const toggleResenias = document.querySelector('.titulo-resenias');

//Constantes contenido txt
const contenidoDescripcion = document.querySelector('.text-description');
const contenidoInfo = document.querySelector('.text-info');
const contenidoResenias = document.querySelector('.text-resenias');

//funciones toggle
/**
 * @description Funcion que muestra y oculta el contenido de la descripcion
 */
toggleDescripcion.addEventListener('click', () => {
    contenidoDescripcion.classList.toggle('hidden');
});
/**
 * @description Funcion que muestra y oculta el contenido de la info
 */
toggleInfo.addEventListener('click', () => {
    contenidoInfo.classList.toggle('hidden');
});
/**
 * @description Funcion que muestra y oculta el contenido de las reseñas
 */
toggleResenias.addEventListener('click', () => {
    contenidoResenias.classList.toggle('hidden');
});