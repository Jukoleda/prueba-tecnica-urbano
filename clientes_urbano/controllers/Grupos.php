<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


require_once('../lib/database/grupoClientes_db.php');
require_once('../models/grupoClienteModel.php');
require_once('../lib/database/Clientes_db.php');
require_once('../models/clienteModel.php');


$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$url = explode('/', $url);

$method = $_SERVER['REQUEST_METHOD'];


if($url[3] == "grupos"){

    if(isset($url[4])){
        switch($url[4]){
            case 'listar':
                $nombre = empty($_POST['nombre']) ? null : $_POST['nombre'];

                $query = json_decode(GrupoClientes_db::Buscar(null, $nombre));

                $grupos = array();

                foreach($query as $element){
                    $grupo = GrupoClienteModel::Create()->setId($element->id)->setNombre($element->nombre);
                    array_push($grupos, $grupo);
                }

                $file = include('../views/partials/ListadoGrupoClientes.php');
                                
                break;
            case 'editar':

                $idGrupo = empty($_POST['idGrupo']) ? 0 : $_POST['idGrupo'];

                $query = json_decode(GrupoClientes_db::Buscar($idGrupo, null))[0];
                $grupo = GrupoClienteModel::Create()
                                            ->setId($query->id)
                                            ->setNombre($query->nombre);
                
                $edicion = true;

            

                include('../views/partials/CamposGrupoClientes.php');

                break;
            case 'guardar':

                    $nombre = empty($_POST['nombre']) ? null : $_POST['nombre'];

                    $query = json_decode(GrupoClientes_db::Guardar($nombre))[0];
    
                    if(isset($query->idGrupoCliente)){
                        echo json_encode(["status" => true, "message" => "Grupo grabado correctamente."]);
                    }else{
                        echo json_encode(["status" => false, "message" => "Ocurrio un error al grabar el grupo."]);
                    }
    
    
                    break;
            case 'guardar_cambios':
    
                    $idGrupo = empty($_POST['idGrupo']) ? 0 : $_POST['idGrupo'];
                    $nombre = empty($_POST['nombre']) ? null : $_POST['nombre'];
                    $estado = empty($_POST['estado']) ? 1 : $_POST['estado'];
    
                    $query = json_decode(GrupoClientes_db::Editar($idGrupo, $nombre))[0];
    
                    if(isset($query->idGrupoCliente)){
                        echo json_encode(["status" => true, "message" => "Cambios guardados correctamente."]);
                    }else{
                        echo json_encode(["status" => false, "message" => "Ocurrio un error al guardar los cambios del grupo."]);
                    }
    
                    break;
            case 'eliminar':

                $idGrupo = empty($_POST['idGrupo']) ? 0 : $_POST['idGrupo'];
                $estado = empty($_POST['estado']) ? 1 : $_POST['estado'];

                //primero se obtienen los clientes pertenecientes al grupo
                $query = json_decode(Clientes_db::Buscar(null, null, null, null, $idGrupo));

                $clientes = array();

                //genero dataset para clientes
                foreach($query as $element){

                    $cliente = ClienteModel::Create()->setId($element->idCliente);

                    array_push($clientes, $cliente);
                }

            
                //elimino el grupo
                $query = json_decode(GrupoClientes_db::Editar($idGrupo, null, $estado))[0];

                if(isset($query->idGrupoCliente)){

                    //si se elimino el grupo elimino los clientes
                    foreach($clientes as $cliente){
                        Clientes_db::Editar($cliente->id, null, null, null, null, null, $estado);
                    }

                    echo json_encode(["status" => true, "message" => "Grupo eliminado correctamente."]);
                }else{
                    echo json_encode(["status" => false, "message" => "Ocurrio un error al eliminar el grupo."]);
                }

                break;
            case 'agregar':

                $edicion = false;

                include('../views/partials/CamposGrupoClientes.php');
                break;
            default: break;
        }
    }
    
}




?>