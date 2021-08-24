<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


require_once('../lib/database/clientes_db.php');
require_once('../lib/database/grupoClientes_db.php');
require_once('../models/clienteModel.php');
require_once('../models/grupoClienteModel.php');

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$url = explode('/', $url);

$method = $_SERVER['REQUEST_METHOD'];


if($url[3] == "clientes"){

    if(isset($url[4])){
        switch($url[4]){

            case 'listar':

                //filtro las variables que llegan por post para evitar errores
                $nombre = empty($_POST['nombre']) ? null : $_POST['nombre'];
                $apellido = empty($_POST['apellido']) ? null : $_POST['apellido'];
                $email = empty($_POST['email']) ? null : $_POST['email'];
                $grupo = empty($_POST['grupo']) ? 0 : $_POST['grupo'];
                
           
                $query = json_decode(Clientes_db::Buscar(null, $nombre, $apellido, $email, $grupo));

                $query_g = json_decode(GrupoClientes_db::Buscar(null, null));
                $clientes = array();
                $grupos = array();

                //genero dataset para clientes
                foreach($query as $element){

                    $cliente = ClienteModel::Create()
                                        ->setId($element->idCliente)
                                        ->setNombre($element->nombreCliente)
                                        ->setApellido($element->apellidoCliente)
                                        ->setEmail($element->emailCliente);

                    $grupo_c = GrupoClienteModel::Create()
                                        ->setId($element->idGrupoCliente)
                                        ->setNombre($element->nombreGrupoCliente);


                    $cliente->setGrupoCliente($grupo_c);

                    array_push($clientes, $cliente);
                }

                //genero dataset para el select de grupos en el buscador
                foreach($query_g as $element){
                    $grupo = GrupoClienteModel::Create()->setId($element->id)->setNombre($element->nombre);
                    array_push($grupos, $grupo);
                }

                include('../views/partials/ListadoClientes.php');
                                
                break;

            case 'editar':

                $idCliente = empty($_POST['idCliente']) ? 0 : $_POST['idCliente'];

                $query = json_decode(Clientes_db::Buscar($idCliente))[0];



                $cliente = ClienteModel::Create()
                                        ->setId($query->idCliente)
                                        ->setNombre($query->nombreCliente)
                                        ->setApellido($query->apellidoCliente)
                                        ->setEmail($query->emailCliente)
                                        ->setObservaciones($query->observacionesCliente);

                $grupo = GrupoClienteModel::Create()
                                    ->setId($query->idGrupoCliente)
                                    ->setNombre($query->nombreGrupoCliente);


                $cliente->setGrupoCliente($grupo);


                $query = json_decode(GrupoClientes_db::Buscar(null, null));

                $grupos = array();
                
                $edicion = true;

                foreach($query as $element){
                    $grupo = GrupoClienteModel::Create()->setId($element->id)->setNombre($element->nombre);
                    array_push($grupos, $grupo);
                }


                include('../views/partials/CamposClientes.php');

                break;
            case 'guardar':

                $nombre = empty($_POST['nombre']) ? null : $_POST['nombre'];
                $apellido = empty($_POST['apellido']) ? null : $_POST['apellido'];
                $email = empty($_POST['email']) ? null : $_POST['email'];
                $grupo = empty($_POST['grupo']) ? 0 : $_POST['grupo'];
                $observaciones = empty($_POST['observaciones']) ? null : $_POST['observaciones'];

                $query = json_decode(Clientes_db::Guardar($nombre, $apellido, $email, $grupo, $observaciones))[0];

                if(isset($query->idCliente)){
                    echo json_encode(["status" => true, "message" => "Cliente grabado correctamente."]);
                }else{
                    echo json_encode(["status" => false, "message" => "Ocurrio un error al grabar el cliente."]);
                }


                break;
            case 'guardar_cambios':

                $idCliente = empty($_POST['idCliente']) ? 0 : $_POST['idCliente'];
                $nombre = empty($_POST['nombre']) ? null : $_POST['nombre'];
                $apellido = empty($_POST['apellido']) ? null : $_POST['apellido'];
                $email = empty($_POST['email']) ? null : $_POST['email'];
                $grupo = empty($_POST['grupo']) ? 0 : $_POST['grupo'];
                $observaciones = empty($_POST['observaciones']) ? null : $_POST['observaciones'];
                $estado = empty($_POST['estado']) ? 1 : $_POST['estado'];

                $query = json_decode(Clientes_db::Editar($idCliente, $nombre, $apellido, $email, $grupo, $observaciones, $estado))[0];

                if(isset($query->idCliente)){
                    echo json_encode(["status" => true, "message" => "Cambios guardados correctamente."]);
                }else{
                    echo json_encode(["status" => false, "message" => "Ocurrio un error al guardar los cambios del cliente."]);
                }

                break;
            case 'eliminar':

                $idCliente = empty($_POST['idCliente']) ? 0 : $_POST['idCliente'];
                $estado = empty($_POST['estado']) ? 1 : $_POST['estado'];

                $query = json_decode(Clientes_db::Editar($idCliente, null, null, null, null, null, $estado))[0];

                if(isset($query->idCliente)){
                    echo json_encode(["status" => true, "message" => "Cliente eliminado correctamente."]);
                }else{
                    echo json_encode(["status" => false, "message" => "Ocurrio un error al eliminar el cliente."]);
                }

                break;
            case 'agregar':

                $query = json_decode(GrupoClientes_db::Buscar(null, null));

                $grupos = array();
                
                $edicion = false;

                foreach($query as $element){
                    $grupo = GrupoClienteModel::Create()->setId($element->id)->setNombre($element->nombre);
                    array_push($grupos, $grupo);
                }


                include('../views/partials/CamposClientes.php');
                break;
            

            default: break;
        }
    }
    
}




?>