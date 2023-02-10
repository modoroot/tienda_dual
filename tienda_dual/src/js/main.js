// const OPEN_MODAL = document.querySelector('.abrir_modal'); // Elemento que abre el modal
// const MODAL = document.querySelector('.modal'); // Elemento modal
// const CLOSE_MODAL = document.querySelector('.modal_close'); // Elemento que cierra el modal
// // Agrega un evento al elemento que abre el modal
// OPEN_MODAL.addEventListener('click', (e) => {
//     e.preventDefault();
//     MODAL.classList.add('modal_show');
// });
// // Agrega un evento al elemento que cierra el modal
// CLOSE_MODAL.addEventListener('click', (e) => {
//     e.preventDefault();
//     MODAL.classList.remove('modal_show');
// });
const inputQuantity = document.querySelector('.input-quantity');
const btnIncrementar = document.querySelector('#incrementar');
const btnDecrementar = document.querySelector('#decrementar');
let valorPredeterminado = parseInt(inputQuantity.value);

//funciones clic
btnIncrementar.addEventListener('click', () => {
    valorPredeterminado+=1;
    inputQuantity.value = valorPredeterminado;
});
btnDecrementar.addEventListener('click', () => {
    if(valorPredeterminado===1){
        return;
    }
    valorPredeterminado-=1;
    inputQuantity.value = valorPredeterminado;
});

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
toggleDescripcion.addEventListener('click', () => {
    contenidoDescripcion.classList.toggle('hidden');
});
toggleInfo.addEventListener('click', () => {
    contenidoInfo.classList.toggle('hidden');
});
toggleResenias.addEventListener('click', () => {
    contenidoResenias.classList.toggle('hidden');
});