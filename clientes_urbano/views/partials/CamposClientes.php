<div class="container mt-4">
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <div class="card">
                <div class="card-body text-center">
                    <span><?= $edicion ? "EDICION DEL CLIENTE" : "NUEVO CLIENTE" ?></span>
                    <div class="container text-start mt-2">
                        <form id="frmCamposClientes">
                            <?= $edicion ? "<input type='hidden' id='idCliente' value='$cliente->id'>" : "" ?>

                            <div class="mb-3">
                                <label for="nombreCliente">Nombre</label>
                                <input type="text" class="form-control" placeholder="Nombre" id="nombreCliente" value="<?= $edicion ? $cliente->nombre : "" ?>" >
                                <div class="text-danger" hidden id="errNombre"><span>El nombre <strong>es obligatorio.</strong></span></div>
                            </div>

                            <div class="mb-3">
                                <label for="apellidoCliente">Apellido</label>
                                <input type="text" class="form-control" placeholder="Apellido"  id="apellidoCliente" value="<?= $edicion ? $cliente->apellido : "" ?>" >
                                <div class="text-danger" hidden id="errApellido"><span>El apellido <strong>es obligatorio.</strong></span></div>
                            </div>

                            <div class="mb-3">
                                <label for="emailCliente">Email</label>
                                <input type="email" class="form-control" placeholder="Email"  id="emailCliente" value="<?= $edicion ? $cliente->email : "" ?>" >
                                <div class="text-danger" hidden id="errEmail"><span>El email <strong>es obligatorio.</strong></span></div>
                                <div class="text-danger" hidden id="errEmail2"><span>El email debe contener <strong>"@"</strong> y luego texto, por ejemplo <strong>example@mail.com</strong></span></div>
                            </div>

                            <div class="mb-3">
                                <label for="grupoCliente">Grupo de clientes</label>
                                <select class="form-select" id="grupoCamposCliente" >
                                    <?= $edicion ? "" : "<option selected value='0'>Seleccionar grupo de clientes</option>" ?>
                                    <?php foreach($grupos as $grupo) { ?>
                                        <option value="<?= $grupo->id ?>" <?= $edicion ? $grupo->id == $cliente->grupoCliente->id ? "selected" : "" : "" ?>><?=$grupo->nombre?></option>
                                        <?php } ?>
                                </select>
                                <div class="text-danger" hidden id="errGrupo"><span>La selección del grupo <strong>es obligatoria.</strong></span></div>
                            </div>
                            <div class="mb-3">
                                <label for="observacionesCliente">Observaciones</label>
                                <input type="text" class="form-control" placeholder="Observaciones" id="observacionesCliente" value="<?= $edicion ? $cliente->observaciones : "" ?>" >
                                <div class="text-danger" hidden id="errObservaciones"><span>Las observaciones <strong>son obligatorias.</strong></span></div>
                            </div>
                            <button class="btn btn-danger float-start btn-sm" id="volverCamposClientes">VOLVER</button>
                            <button class="btn btn-primary float-end btn-sm" id="<?= $edicion ? "guardarCambiosCamposClientes" : "guardarCamposClientes" ?>">GUARDAR</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>