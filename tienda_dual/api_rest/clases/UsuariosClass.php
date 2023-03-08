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
            if($verificar){
                $respuesta = $_respuesta->response;
                $respuesta["result"] = array(
                    "id_usuario" => $verificar
                );
                return $respuesta;
            }else{
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
}
