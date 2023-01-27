function cargaTabla() {
    $.ajax({
        type: "POST",
        async: true,
        url: FICHERO,
        data: {opcion: 1},
        success: function (data) {
            $("#datatablesSimple").DataTable().destroy();
            $('#datatablesSimple tbody').html(data);
            $("#datatablesSimple").DataTable();
        },
    });
}


function eliminaRegistro(id) {
    $.ajax({
        type: "POST",
        async: true,
        url: FICHERO,
        data: {opcion: 2, id: id},
        success: function (data) {
            if (data == true) {
                alert("Registro eliminado correctamente");
            } else {
                alert(data);
            }
            cargaTabla();
        },
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
            $("input[type=text]").val(data.nombre);
            $("textarea").val(data.descripcion);
        },
    });
}



function guardar(id) {
    var fd = new FormData(document.getElementById("modal-form"));
    fd.append("opcion", 4);
    fd.append('id', id);
    $('#modal-form input,#modal-form select,#modal-form textarea').each(function(){
       fd.append($(this).attr("id"), $(this).val());
    })
    console.log(fd);
    $.ajax({
        url: FICHERO,
        type: "POST",
        data: fd,
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        dataType: "json"
    }).done(function (data) {
        cargaTabla();
    });
}