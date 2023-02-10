const OPEN_MODAL = document.querySelector('.abrir_modal'); // Elemento que abre el modal
const MODAL = document.querySelector('.modal'); // Elemento modal
const CLOSE_MODAL = document.querySelector('.modal_close'); // Elemento que cierra el modal
// Agrega un evento al elemento que abre el modal
OPEN_MODAL.addEventListener('click', (e) => {
    e.preventDefault();
    MODAL.classList.add('modal_show');
});
// Agrega un evento al elemento que cierra el modal
CLOSE_MODAL.addEventListener('click', (e) => {
    e.preventDefault();
    MODAL.classList.remove('modal_show');
});