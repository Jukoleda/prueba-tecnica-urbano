<?php




require_once('./lib/autoload.php');

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

require_once('views/Index.php');


?>