<?php
require_once 'conexion/Conexion.php';
require_once 'Respuesta.php';

class AuthClass extends Conexion
{
    public function login($json)
    {
        $_respuesta = new Respuesta();
        $datos = json_decode($json, true);
        if (!isset($datos['username']) || !isset($datos['password'])) {
            return $_respuesta->error_400();
        }else{
            $username = $datos['username'];
            $password = $datos['password'];
            $password = parent::encriptar($password);
            $datos = $this->obtenerDatosUsuario($username);
            if ($datos) {
                if($password == $datos[0]['password']){
                    }else{
                        return $_respuesta->error_200("Contraseña inválida");
                    }

            }else{
                return $_respuesta->error_200("El usuario $username no existe");
            }
        }
    }
    private function obtenerDatosUsuario($nombreUsuario) {
        $query = "SELECT * FROM usuario WHERE username = '$nombreUsuario'";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]['id_usuario'])) {
            return $datos;
        }else{
            return 0;
        }
    }
    private function insertarToken($id_usuario){
        $val = true;
        $token = bin2hex(openssl_random_pseudo_bytes(16, $val));
        $date = date("Y-m-d H:i");

    }
}