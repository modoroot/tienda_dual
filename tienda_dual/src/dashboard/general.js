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

function eliminaRegistro(id) {
    console.log(id);
    $.ajax({
        type: "POST",
        async: true,
        url: "tabla_privilegio.php",
        data: {opcion:2,id_privilegio:id},
        success:  function(data){
            console.log(data);
            if(data==true){
                alert("Registro eliminado correctamente");
            }else{
                alert(data);
            }
            cargaTabla();
        },
    });
}

function aniadirRegistro() {

}
