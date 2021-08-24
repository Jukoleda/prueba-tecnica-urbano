<div class="container mt-4">
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
        <div class="card">
                <div class="card-body text-center">
                    <span>BUSCAR</span>
                    <div class="container mt-2">
                        <div class="row">
                            <div class="col-md-6 offset-md-1">
                                <div class="mb-3">
                                    <label for="emailCliente">Nombre</label>
                                    <input type="email" class="form-control" id="filtroListadoGrupos">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mt-4">
                                    <button class="btn btn-danger btn-md" id="limpiarBuscadorListadoGrupos">LIMPIAR FILTRO</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body text-center">
                    <span>LISTADO DE GRUPOS</span>
                    <button class="btn btn-success btn-sm float-end" id="nuevoGrupo">NUEVO</button>
                    <?php if(count($grupos) == 0) { ?>
                        <div class="container bg-warning mt-5">
                            <span>No se encontraron grupos</span>
                        </div>
                    <?php } else { ?>
                        <table class="table table-striped text-center mt-4">
                            <thead class="table-dark">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($grupos as $grupo) { ?>
                                    <tr>
                                        <td><?= $grupo->nombre ?></td>
                                        <td> 
                                            <i class="fas fa-edit text-primary editarGrupo" data-idgrupo="<?= $grupo->id ?>"></i>
                                            <i class="fas fa-trash text-danger eliminarGrupo" data-idgrupo="<?= $grupo->id ?>"></i>
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