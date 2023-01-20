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
    $.ajax({
        type: "POST",
        async: true,
        url: "tabla_privilegio.php",
        data: {opcion:2,id_privilegio:id},
        success:  function(data){
            if(data==true){
                alert("Registro eliminado correctamente");
            }else{
                alert(data);
            }
            cargaTabla();
        },
    });
}

function aniadirRegistro(nombre_priv, descripcion_priv) {
    $.ajax({
        type: "POST",
        async: true,
        url: "tabla_privilegio.php",
        data: {opcion:3,nombre:nombre_priv,descripcion:descripcion_priv},
        success:  function(data){
            cargaTabla();
        },
    });
}

function editarRegistro(id_priv,nombre_priv, descripcion_priv) {
    $.ajax({
        type: "POST",
        async: true,
        url: "tabla_privilegio.php",
        data: {opcion:4,id_privilegio:id_priv,nombre:nombre_priv,descripcion:descripcion_priv},
        success:  function(data){
            cargaTabla();
        },
    });
}

function cargarRegistro(id_priv, nombre_priv, descripcion_priv) {
    $.ajax({
        type: "POST",
        async: true,
        url: "tabla_privilegio.php",
        data: {opcion:5,id_privilegio:id_priv,nombre:nombre_priv,descripcion:descripcion_priv},
        success:  function(data){
            cargaTabla();
        },
    });
}

