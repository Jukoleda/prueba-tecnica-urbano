<?php

class GrupoClienteModel {

    function __constructor(){
    }

    public static function Create(){
        return new self();
    }

    public function setId($id){
        $this->id = $id;
        return $this;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
        return $this;
    }
   
}


?>