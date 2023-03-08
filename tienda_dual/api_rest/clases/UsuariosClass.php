<?php
require_once 'conexion/Conexion.php';
require_once 'Respuesta.php';
class UsuariosClass extends Conexion
{
    private $tabla = "usuario";
    private $id_usuario = "";
    private $nombre = "";
    private $username = "";
    private $password = "";
    private $email = "";
    private $id_privilegio = "";

    public function listaUsuarios($pagina = 1)
    {
        $inicio = 0;
        $cantidad = 2;
        if ($pagina > 1) {
            $inicio = ($cantidad * ($pagina - 1)) + 1;
            $cantidad = $cantidad * $pagina;
        }
        $query = "SELECT * FROM " . $this->tabla . " LIMIT $inicio, $cantidad";
        $datos = parent::obtenerDatos($query);
        return ($datos);
    }
    public function obtenerUsuario($id_usuario)
    {
        $query = "SELECT * FROM " . $this->tabla . " WHERE id_usuario = $id_usuario";
        $datos = parent::obtenerDatos($query);
        return ($datos);
    }
    public function post($json)
    {
        $_respuesta = new Respuesta();
        $datos = json_decode($json, true);
        if (!isset($datos['username']) || !isset($datos['password'])) {
            return $_respuesta->error_400();
        } else {
            //Verificar si se ha introducido un nombre
            if (isset($datos['nombre'])) {
                $this->nombre = $datos['nombre'];
            }
            $this->username = $datos['username'];
            $this->password = $datos['password'];
            //Verificar si se ha introducido un email
            if (isset($datos['email'])) {
                $this->email = $datos['email'];
            }
            $this->id_privilegio = $datos['id_privilegio'];

            $verificar = $this->insertarUsuario();
            if ($verificar) {
                $respuesta = $_respuesta->response;
                $respuesta["result"] = array(
                    "id_usuario" => $verificar
                );
                return $respuesta;
            } else {
                return $_respuesta->error_500();
            }
        }
    }

    private function insertarUsuario()
    {
        $query = "INSERT INTO " . $this->tabla . " (nombre, username, password, email, id_privilegio) VALUES
        ('" . $this->nombre . "', '" . $this->username . "', '" . $this->password . "', '"
            . $this->email . "', '" . $this->id_privilegio . "')";
        $verificar = parent::nonQueryId($query);
        if ($verificar) {
            return $verificar;
        } else {
            return 0;
        }
    }

    public function put($json)
    {
        $_respuesta = new Respuesta();
        $datos = json_decode($json, true);
        if (!isset($datos['id_usuario'])) {
            return $_respuesta->error_400();
        } else {
            $this->id_usuario = $datos['id_usuario'];
            //Verificar si se ha introducido un nombre
            if (isset($datos['nombre'])) {
                $this->nombre = $datos['nombre'];
            }
            if (isset($datos['username'])) {
                $this->username = $datos['username'];
            }
            if (isset($datos['password'])) {
                $this->password = $datos['password'];
            }
            //Verificar si se ha introducido un email
            if (isset($datos['email'])) {
                $this->email = $datos['email'];
            }
            if (isset($datos['id_privilegio'])) {
                $this->id_privilegio = $datos['id_privilegio'];
            }
            $verificar = $this->actualizarUsuario();
            if ($verificar) {
                $respuesta = $_respuesta->response;
                $respuesta["result"] = array(
                    "id_usuario" => $this->id_usuario
                );
                return $respuesta;
            } else {
                return $_respuesta->error_500();
            }
        }
    }
    private function actualizarUsuario()
    {
        $query = "UPDATE " . $this->tabla . " SET nombre = '" . $this->nombre . "', username = '"
         . $this->username . "', password = '" . $this->password . "', email = '" . $this->email 
         . "', id_privilegio = '" . $this->id_privilegio . "' WHERE id_usuario = '" . $this->id_usuario . "'";
        $verificar = parent::nonQuery($query);
        if ($verificar >= 1) {
            return $verificar;
        } else {
            return 0;
        }
    }
}
