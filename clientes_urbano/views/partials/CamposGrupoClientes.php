<div class="container mt-4">
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <div class="card">
                <div class="card-body text-center">
                    <span><?= $edicion ? "EDICION DEL GRUPO" : "NUEVO GRUPO" ?></span>
                    <div class="container text-start mt-2">
                        <?= $edicion ? "<input type='hidden' id='idGrupo' value='$grupo->id'>" : "" ?>
                        <div class="mb-3">
                            <label for="nombreGrupo">Nombre</label>
                            <input type="text" class="form-control" placeholder="Nombre" id="nombreGrupo" value="<?= $edicion ? $grupo->nombre : "" ?>">
                            <div class="text-danger" hidden id="errNombreGrupo"><span>El nombre <strong>es obligatorio.</strong></span></div>

                        </div>
                       
                        <button class="btn btn-danger float-start btn-sm" id="volverCamposGrupoClientes">VOLVER</button>
                        <button class="btn btn-primary float-end btn-sm"  id="<?= $edicion ? "guardarCambiosCamposGrupoClientes" : "guardarCamposGrupoClientes" ?>">GUARDAR</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>