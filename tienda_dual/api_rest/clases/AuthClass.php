<?php
require_once 'conexion/Conexion.php';
require_once 'Respuesta.php';

class AuthClass extends Conexion
{
    public function login($json){
        $_respuesta = new Respuesta();
        $datos = json_decode($json, true);
        if (!isset($datos['username']) || !isset($datos['password'])) {
            return $_respuesta->error_400();
        } else {
            $username = $datos['username'];
            $password = $datos['password'];
            $password = parent::encriptar($password);
            $datos = $this->obtenerDatosUsuario($username);
            if ($datos) {
                if ($password == $datos[0]['password']) {
                    //admin
                    if ($datos[0]['id_privilegio'] == 1 || $datos[0]['id_privilegio'] == 64) {
                        $verificar = $this->insertarToken($datos[0]['id_usuario']);
                        if($verificar){
                            $result = $_respuesta->response;
                            $result["result"] = array(
                                "token" => $verificar
                            );
                            return $result;
                        }else{
                            return $_respuesta->error_500("Error interno del servidor, por favor intenta de nuevo");
                        }
                    } else {
                        return $_respuesta->error_200("El usuario no tiene privilegios");
                    }
                } else {
                    return $_respuesta->error_200("Contraseña inválida");
                }

            } else {
                return $_respuesta->error_200("El usuario $username no existe");
            }
        }
    }

    private function obtenerDatosUsuario($nombreUsuario)
    {
        $query = "SELECT * FROM usuario WHERE username = '$nombreUsuario'";
        $datos = parent::obtenerDatos($query);
        if (isset($datos[0]['id_usuario'])) {
            return $datos;
        } else {
            return 0;
        }
    }

    private function insertarToken($id_usuario)
    {
        $query = "SELECT * FROM usuario WHERE id_usuario = '$id_usuario'";
        $datos = parent::obtenerDatos($query);
        $val = true;
        $token = bin2hex(openssl_random_pseudo_bytes(16, $val));
        $date = date("Y-m-d H:i");
        $id_privilegio = $datos[0]['id_privilegio'];
        $query = "INSERT INTO tokens VALUES (NULL,'$token', '$date', '$id_privilegio', '$id_usuario')";
        $verifica = parent::nonQueryId($query);
        if ($verifica) {
           return $token;
        }
        else {
            return 0;
        }
    }
}