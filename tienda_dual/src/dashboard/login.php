<?php
require 'conn.php';
session_start();
if ($_POST) {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM usuario WHERE username='$usuario'";
    $result = $mysqli->query($sql);
    $num = $result->num_rows;
    if ($num > 0) {
        $row = $result->fetch_assoc();
        $password_bd = $row['password'];
        $pass_c = sha1($password);
        if ($password_bd == $pass_c) {
            $_SESSION['id_usuario'] = $row['id_usuario'];
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['id_privilegio'] = $row['id_privilegio'];
            header("Location: principal.php");
        } else {
            echo "Contraseña inválida";
        }
    } else {
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
