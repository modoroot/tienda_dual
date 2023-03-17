<?php
// se importa la conexión a la base de datos
require 'conn.php';

// se inicia una sesión
session_start();
<<<<<<< HEAD
//Comprueba si se ha enviado la información a través del método POST
if ($_POST) { 
    //Obtiene el nombre de usuario enviado en el formulario
    $usuario = $_POST['usuario'];
    //Obtiene la contraseña enviada en el formulario
    $password = $_POST['password']; 
    //Consulta SQL para obtener información de la base de datos sobre el usuario introducido en el formulario
    $sql = "SELECT * FROM usuario WHERE username='$usuario'"; 
    //Ejecuta la consulta
    $result = $mysqli->query($sql); 
    //Obtiene el número de filas devueltas por la consulta (si es 0, significa que el usuario no existe)
    $num = $result->num_rows; 
    //Si hay al menos una fila (el usuario existe en la BD)
    if ($num > 0) { 
        //Obtiene los datos del usuario como un array asociativo
        $row = $result->fetch_assoc(); 
        //Obtiene la contraseña almacenada en la BD para ese usuario
        $password_bd = $row['password'];
        //Codifica la contraseña introducida por el usuario en SHA1
        $pass_c = sha1($password); 
        //Compara la contraseña almacenada con la introducida por el usuario
        if ($password_bd == $pass_c) { 
            //Crea la variable de sesión con el id del usuario
            $_SESSION['id_usuario'] = $row['id_usuario']; 
            //Crea la variable de sesión con el nombre del usuario
            $_SESSION['nombre'] = $row['nombre']; 
            //Crea la variable de sesión con el username
            $_SESSION['username'] = $row['username']; 
            //Crea la variable de sesión con el id de privilegio del usuario
            $_SESSION['id_privilegio'] = $row['id_privilegio']; 
            //Redirige al usuario a otra página (en este caso, la página principal)
            header("Location: principal.php"); 
            //Si la contraseña no coincide con la almacenada en la BD
        } else { 
            echo "Contraseña inválida";
        }
        //Si no hay ninguna fila que coincida con el usuario introducido
    } else { 
=======

// si se envió información por el método POST
if ($_POST) {

    // se obtiene el usuario y la contraseña enviados por POST
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // se crea una consulta SQL para buscar al usuario en la base de datos
    $sql = "SELECT * FROM usuario WHERE username='$usuario'";

    // se ejecuta la consulta en la base de datos
    $result = $mysqli->query($sql);

    // se cuenta el número de resultados obtenidos de la consulta
    $num = $result->num_rows;

    // si se encontró al menos un usuario con ese nombre
    if ($num > 0) {
        
        // se obtiene la información del usuario de la primera fila del resultado
        $row = $result->fetch_assoc();

        // se obtiene la contraseña del usuario de la base de datos
        $password_bd = $row['password'];

        // se calcula el hash de la contraseña enviada por el usuario
        $pass_c = sha1($password);

        // si la contraseña es correcta
        if ($password_bd == $pass_c) {
            
            // se guardan algunos datos del usuario en la sesión
            $_SESSION['id_usuario'] = $row['id_usuario'];
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['id_privilegio'] = $row['id_privilegio'];

            // se redirige al usuario a la página principal
            header("Location: principal.php");
        } else {
            // si la contraseña es incorrecta, se muestra un mensaje de error
            echo "Contraseña inválida";
        }
    } else {
        // si no se encontró ningún usuario con ese nombre, se muestra un mensaje de error
>>>>>>> e1e1cb1bb0c838f98ee070a72e6083467cec2a7b
        echo "Usuario no válido";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Login - Framerate</title>
    <link href="css/styles.css" rel="stylesheet"/>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="bg-primary">
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Iniciar sesión</h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <div class="form-floating mb-3">
                                        <input name="usuario" class="form-control" type="text"
                                               placeholder="Introduce tu usuario"/>
                                        <label for="inputEmail">Usuario</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input name="password" class="form-control" type="password"
                                               placeholder="Introduce tu contraseña"/>
                                        <label for="inputPassword">Contraseña</label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" id="inputRememberPassword" type="checkbox"
                                               value=""/>
                                        <label class="form-check-label" for="inputRememberPassword">Remember
                                            Password</label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <a class="small" href="password.html">Forgot Password?</a>
                                        <button type="submit" class="btn btn-primary">Login</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="layoutAuthentication_footer">
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2022</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
</body>
</html>
