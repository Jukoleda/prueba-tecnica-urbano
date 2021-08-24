<div class="container mt-4">
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <div class="card">
                <div class="card-body text-center">
                    <span>BUSCAR</span>
                    <div class="container mt-2">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="emailCliente">Filtro</label>
                                    <input type="text" class="form-control" placeholder="Ingrese nombre, apellido y/o email" id="filtroListadoClientes">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="grupoCliente">Grupo de clientes</label>
                                    <select class="form-select" id="grupoCliente">
                                        <option selected value="">Seleccionar grupo</option>
                                        <?php foreach($grupos as $grupo) { ?>
                                            <option value="<?= $grupo->id ?>"><?=$grupo->nombre?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            
                            
                            <div class="col-md-3">
                                <div class="mt-4">
                                    <button class="btn btn-danger btn-md" id="limpiarBuscadorListadoClientes">LIMPIAR FILTROS</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body text-center">
                    <span>LISTADO DE CLIENTES</span>
                    <button class="btn btn-success btn-sm float-end" id="nuevoCliente">NUEVO</button>
                        <?php if(count($clientes) == 0) { ?>
                            <div class="container bg-warning mt-5">
                                <span>No se encontraron clientes</span>
                            </div>
                        <?php } else { ?>
                            <table class="table table-striped text-center mt-4">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Email</th>
                                        <th>Grupo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($clientes as $cliente) { ?>
                                        <tr>
                                            <td><?= $cliente->nombre ?></td>
                                            <td><?= $cliente->apellido ?></td>
                                            <td><?= $cliente->email ?></td>
                                            <td>
                                                <select class="form-select form-select-sm grupoClienteListado" data-idcliente="<?= $cliente->id ?>">
                                                    <?php foreach($grupos as $grupo) { ?>
                                                        <option value="<?= $grupo->id ?>" <?= $grupo->id == $cliente->grupoCliente->id ? "selected" : "" ?>><?=$grupo->nombre?></option>
                                                        <?php } ?>
                                                    </select>        
                                                </td>
                                                <td> 
                                                    <i class="fas fa-edit text-primary editarCliente" data-idcliente="<?= $cliente->id ?>"></i>
                                                    <i class="fas fa-trash text-danger eliminarCliente" data-idcliente="<?= $cliente->id ?>"></i>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            