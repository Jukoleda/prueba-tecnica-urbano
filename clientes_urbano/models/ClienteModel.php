<?php

class ClienteModel {

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
    public function setApellido($apellido){
        $this->apellido = $apellido;
        return $this;
    }
    public function setEmail($email){
        $this->email = $email;
        return $this;
    }
    public function setObservaciones($observaciones){
        $this->observaciones = $observaciones;
        return $this;
    }
    public function setGrupoCliente(GrupoClienteModel $grupoCliente){
        $this->grupoCliente = $grupoCliente;
        return $this;
    }

}


?>