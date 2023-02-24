// Esperamos a que el DOM esté listo
$(document).ready(function () {
    // Añadimos un evento al botón de "chat-toggle"
    $('.chat-toggle').click(function () {
        // Cuando se hace clic, añadimos o quitamos la clase "show" en el contenedor de chat
        $('.chat-container').toggleClass('show');
    });

    // Añadimos un evento al botón de cerrar
    $('.chat-header .close').click(function () {
        // Cuando se hace clic, quitamos la clase "show" en el contenedor de chat
        $('.chat-container').removeClass('show');
    });

    // Añadimos un evento al botón de "enviar-mensaje"
    $('#enviar-mensaje').click(function () {
        // Obtenemos el valor del input
        var mensaje = $('input[type="text"]').val();
        // Si el valor no está vacío
        if (mensaje !== '') {
            // Agregamos un nuevo elemento li con el mensaje y lo añadimos a la lista ul
            $('.chat-body ul').append('<li><strong>Tú:</strong> ' + mensaje + '</li>');
            // Limpiamos el valor del input
            $('input[type="text"]').val('');
        }
    });

    // Añadimos un evento al input de "enviar-mensaje"
    $('input[type="text"]').keypress(function (event) {
        // Si se presiona la tecla "Enter"
        if (event.which === 13) {
            // Evitamos que el evento por defecto se dispare
            event.preventDefault();
            // Hacemos clic en el botón de "enviar-mensaje"
            $('#enviar-mensaje').click();
        }
    });
});

/**
 * Función que carga los mensajes del chat
 * @param id_session Identificador de la sesión del chat
 */
function cargarMensajesChat(id_session) {
    console.log(id_session);
    $.ajax({
        type: "POST",
        async: true,
        url: "tabla_chat.php",
        data: {opcion: 6, id_session: id_session},
        dataType: "json",
        success: function (data) {
            // Establece los valores de los elementos del formulario con los datos recibidos
            $(".mensaje-lista").text(data.mensaje);
            console.log(data.mensaje);
        },
    });
}
