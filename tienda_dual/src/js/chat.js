// Obtener elementos del DOM
const chatContainer = document.querySelector('.chat-container');
const chatBody = chatContainer.querySelector('.chat-body');
const mensajeInput = chatContainer.querySelector('input[type="text"]');
const enviarMensajeButton = chatContainer.querySelector('#enviar-mensaje');
const chatToggle = document.querySelector('.chat-toggle');

// Función para enviar un mensaje
function enviarMensaje() {
    // Obtener el mensaje del input y el id de sesión de PHP
    const messageText = mensajeInput.value;
    const sessionId = "<?php echo session_id(); ?>"; // Obtener el id de sesión de PHP

    // Crear objeto FormData para enviar los datos
    const formData = new FormData();
    formData.append('mensaje', messageText);
    formData.append('sesion', sessionId);

    // Crear y enviar la solicitud AJAX
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'conn/guardar_mensaje.php');
    xhr.send(formData);
    xhr.onload = function () {
        const message = document.createElement("div");
        // message.classList.add("message", "outgoing");
        message.innerHTML = `<div class="message-content">${messageText}</div><div class="message-timestamp" style="font-size: 10px">${(new Date()).toLocaleString()}</div>`;
        chatBody.appendChild(message);

    };

    // Limpiar el input
    mensajeInput.value = '';
}

// Función para mostrar/ocultar el chat
function toggleChat() {
    chatContainer.classList.toggle('show');
}

// Escuchar el evento click del botón de enviar
enviarMensajeButton.addEventListener('click', enviarMensaje);

// Escuchar el evento keydown del input de mensaje
mensajeInput.addEventListener('keydown', function (event) {
    // Si se presiona Enter
    if (event.keyCode === 13) {
        // Evita que dé un salto de línea
        event.preventDefault();
        // Envía el mensaje introducido
        enviarMensaje();
    }
});

// Escuchar el evento click del botón de desplegable
chatToggle.addEventListener('click', toggleChat);