function cargaTabla() {
    $.ajax({
        type: "POST",
        async: true,
        url: "tabla_privilegio.php",
        data: {opcion:1},
        success:  function(data){
            $("#datatablesSimple").DataTable().destroy();
            $('#datatablesSimple tbody').html(data);
            $("#datatablesSimple").DataTable();
        },
    });
}