<?php

require_once 'database.php';

class Clientes_db {

    public static function Buscar($id = null, $nombre = null, $apellido = null, $email = null, $grupo = null){
        
        $id = $id == 0  ? 'null' : $id;
        $nombre = is_null($nombre) ? '' : $nombre;
        $apellido = is_null($apellido) ? '' : $apellido;
        $email = is_null($email) ? '' : $email;
        $grupo =  $grupo == 0 ? 'null' : $grupo;
        
        $query = "call spListarClientes($id, '$nombre', '$apellido', '$email', $grupo);";

        $res = Database::Query($query);

        return json_encode($res);

    }

    public static function Guardar($nombre = null, $apellido = null, $email = null, $grupo = null, $observaciones = null){
         
        $nombre = is_null($nombre) ? 'null' : $nombre;
        $apellido = is_null($apellido) ? 'null' : $apellido;
        $email = is_null($email) ? 'null' : $email;
        $grupo =  $grupo == 0 ? 'null' : $grupo;
        $observaciones = is_null($observaciones) ? 'null' : $observaciones;
        
        $query = "call spAgregarClientes('$nombre', '$apellido', '$email', $grupo, '$observaciones');";
        $res = Database::Query($query);

        return json_encode($res);
    }

    public static function Editar($id = null, $nombre = null, $apellido = null, $email = null, $grupo = null, $observaciones = null, $estado = null){
        
        if($id == 0 || $id == null){
            return json_encode([["status" => false]]);
        }
        
        $original = json_decode(self::Buscar($id))[0];

        $nombre = is_null($nombre) ? $original->nombreCliente : $nombre;
        $apellido = is_null($apellido) ? $original->apellidoCliente : $apellido;
        $email = is_null($email) ? $original->emailCliente : $email;
        $grupo =  $grupo == 0 ? $original->idGrupoCliente : $grupo;
        $observaciones = is_null($observaciones) ? $original->observacionesCliente : $observaciones;
        $estado = $estado == 2 ? 0 : 1;
        
        $query = "call spModificarClientes($id, '$nombre', '$apellido', '$email', $grupo, '$observaciones', $estado);";
        $res = Database::Query($query);
        return json_encode($res);
    }

}

?>