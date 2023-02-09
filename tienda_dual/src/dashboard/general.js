/**
 * Función que carga la tabla de datos
 */
function cargaTabla() {
    // Realiza una solicitud AJAX al servidor
    $.ajax({
        type: "POST", // Método de envío de datos
        async: true, // Habilita la asincronía para la solicitud
        url: FICHERO, // URL a la que se envía la solicitud. En este caso, es el fichero que esté en la variable FICHERO
        data: {opcion: 1}, // Datos enviados al servidor
        success: function (data) {
            // Destruye la tabla actual
            $("#datatablesSimple").DataTable().destroy();
            // Agrega los datos devueltos por el servidor en el cuerpo de la tabla
            $('#datatablesSimple tbody').html(data);
            // Inicializa una nueva tabla
            $("#datatablesSimple").DataTable();
        },
    });
}

/**
 * Función que elimina un registro
 * @param id Identificador del registro
 */
function eliminaRegistro(id) {
    // Realiza una solicitud AJAX al servidor
    $.ajax({
        type: "POST", // Método de envío de datos
        async: true, // Habilita la asincronía para la solicitud
        url: FICHERO, // URL a la que se envía la solicitud
        data: {opcion: 2, id: id}, // Datos enviados al servidor
        success: function (data) {
            // Verifica si se eliminó el registro correctamente
            if (data == true) {
                // Muestra un mensaje de éxito
                alert("Registro eliminado correctamente");
            } else {
                // Muestra un mensaje de error
                alert(data);
            }
            // Vuelve a cargar la tabla
            cargaTabla();
        },
    });
}

/**
 * Función para guardar un registro nuevo o uno existente en la base de datos (dependiendo del valor del parámetro id)
 * Si es nulo se crea un registro nuevo, si no, se actualiza el registro existente
 * @param id Identificador del registro
 */
function guardar(id) {
    // Crea un nuevo objeto FormData
    var fd = new FormData(document.getElementById("modal-form"));
    // Agrega la opción y el ID a los datos del formulario
    fd.append("opcion", 4);
    fd.append('id', id);
    // Itera sobre todos los elementos del formulario
    $('#modal-form input,#modal-form select,#modal-form textarea,#modal-form select').each(function () {
        // Agrega cada elemento al objeto FormData
        fd.append($(this).attr("id"), $(this).val());
    })
    // Realiza una solicitud AJAX al servidor
    $.ajax({
        url: FICHERO, // URL a la que se envía la solicitud
        type: "POST", // Método de envío de datos
        data: fd, // Datos enviados al servidor
        enctype: 'multipart/form-data', // Tipo de contenido
        processData: false, // No procesa los datos
        contentType: false, // No establece el tipo de contenido
        dataType: "json" // Tipo de datos esperados de la respuesta
    }).done(function (data) {
        // Recarga la tabla después de guardar el registro
        cargaTabla();
    });
}

function cargarRegistro(id) {
    $.ajax({
        type: "POST",
        async: true,
        url: FICHERO,
        data: {opcion: 5, id: id},
        dataType: "json",
        success: function (data) {
            $(".input-nombre").val(data.nombre);
            $(".input-usuario").val(data.username);
            $(".input-precio").val(data.precio);
            $(".input-precio-total").val(data.precio_total);
            $(".input-fecha-pedido").val(data.fecha_pedido);
            $(".input-codigo-pedido").val(data.codigo_pedido);
            $("input[type=password]").val(data.password);
            $("input[type=email]").val(data.email);
            $(".select-clave-ajena-producto").val(data.id_producto);
            $(".select-clave-ajena-privilegio").val(data.id_privilegio);
            $(".select-clave-ajena-categoria").val(data.id_categoria);
            $(".select-clave-ajena-usuario").val(data.id_usuario);
            $("textarea").val(data.descripcion);
            console.log(data);
        },
    });
}



