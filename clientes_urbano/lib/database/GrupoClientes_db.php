<?php

require_once 'database.php';

class GrupoClientes_db {

    public static function Buscar($id = null, $nombre = null){

        $id = $id == 0  ? 'null' : $id;
        $nombre = is_null($nombre) ? '' : $nombre;
        
        $query = "call spListarGrupoClientes($id, '$nombre');";
        $res = Database::Query($query);

        return json_encode($res);
    }

    

    public static function Guardar($nombre = null){
         
        $nombre = is_null($nombre) ? 'null' : $nombre;
        
        $query = "call spAgregarGrupoClientes('$nombre');";
        $res = Database::Query($query);

        return json_encode($res);
    }

    public static function Editar($id = null, $nombre = null, $estado = null){
        
        if($id == 0 || $id == null){
            return json_encode([["status" => false]]);
        }
        
        $original = json_decode(self::Buscar($id))[0];

        $nombre = is_null($nombre) ? $original->nombre : $nombre;
        $estado = $estado == 2 ? 0 : 1;
        
        $query = "call spModificarGrupoClientes($id, '$nombre', $estado);";
        $res = Database::Query($query);
        return json_encode($res);
    }

}

?>