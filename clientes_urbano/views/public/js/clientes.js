$(function(){
    //clientes
    //vista ListadoClientes.php
    $(document).on('click', '.editarCliente', function(){

        let idCliente = $(this).data('idcliente');

        $.ajax({
            method: 'POST',
            dataType: 'html',
            url: 'controllers/clientes/editar',
            data: {idCliente: idCliente},
            success: function (data) {
                $('#main').empty();
                $('#main').append(data);
            }
        });
    });

    $(document).on('keyup', '#filtroListadoClientes', function(){
        let filtro = $("#filtroListadoClientes").val();
        let grupo = $("#grupoCliente").val();

        $.ajax({
            method: 'POST',
            dataType: 'html',
            url: 'controllers/clientes/listar',
            data: {nombre: filtro, apellido: filtro, email: filtro, grupo: grupo},
            success: function(data) {                
                $("#main").empty();
                $("#main").append(data);
                $("#filtroListadoClientes").val(filtro);
                $("#filtroListadoClientes").focus();
                $("#grupoCliente").val(grupo);

            }
            
        });
    });

    $(document).on('change', '#grupoCliente', function(){
        let filtro = $("#filtroListadoClientes").val();
        let grupo = $("#grupoCliente").val();

        $.ajax({
            method: 'POST',
            dataType: 'html',
            url: 'controllers/clientes/listar',
            data: {nombre: filtro, apellido: filtro, email: filtro, grupo: grupo},
            success: function(data) {                
                $("#main").empty();
                $("#main").append(data);
                $("#filtroListadoClientes").val(filtro);
                $("#filtroListadoClientes").focus();
                $("#grupoCliente").val(grupo);
                
            }
            
        });
    });
    
    $(document).on('click', '#limpiarBuscadorListadoClientes', function(){
        $.ajax({
            method: 'POST',
            dataType: 'html',
            url: 'controllers/clientes/listar',
            success: function(data) {                
                $("#main").empty();
                $("#main").append(data);
            }
            
        });
    });

    $(document).on('click', '#nuevoCliente', function(){
        $.ajax({
            method: 'POST',
            dataType: 'html',
            url: 'controllers/clientes/agregar',
            success: function(data) {                
                $("#main").empty();
                $("#main").append(data);
            }
            
        });
    });

    $(document).on('click', '.eliminarCliente', function(){
       if (confirm("¿Desea eliminar el cliente?") == true) {
           
        let idCliente = $(this).data('idcliente');
        $.ajax({
                method: 'POST',
                dataType: 'html',
                url: 'controllers/clientes/eliminar',
                data: {idCliente: idCliente, estado: 2},
                success: function(data) {         
                    data = JSON.parse(data);
                    if(data.status){
                        $("#messageType").removeClass('bg-danger');
                        $("#messageType").addClass('bg-success');
                    }else{
                        $("#messageType").removeClass('bg-success');
                        $("#messageType").addClass('bg-danger');
                    }
                    $("#messageResult").empty();
                    $("#messageResult").append(data.message);
                    $(".toast").toast('show');
                    $("#clientes").trigger('click');
                    
                }
            });
        }
    });


    $(document).on('change', '.grupoClienteListado', function(){
        let grupo = $(this).val();
        let idCliente = $(this).data('idcliente');
        $.ajax({
            method: 'POST',
            dataType: 'html',
            url: 'controllers/clientes/guardar_cambios',
            data: {idCliente: idCliente, grupo: grupo},
            success: function(data) {         
                data = JSON.parse(data);
                if(data.status){
                    $("#messageType").removeClass('bg-danger');
                    $("#messageType").addClass('bg-success');
                }else{
                    $("#messageType").removeClass('bg-success');
                    $("#messageType").addClass('bg-danger');
                }
                $("#messageResult").empty();
                $("#messageResult").append(data.message);
                $(".toast").toast('show');
                $("#clientes").trigger('click');
                
            }
        });
    });
    
    //vista CamposClientes.php
    $(document).on('click', '#volverCamposClientes', function(){
        $.ajax({
            method: 'POST',
            dataType: 'html',
            url: 'controllers/clientes/listar',
            success: function(data) {                
                $("#main").empty();
                $("#main").append(data);
            }
            
        });
    });

    
     $(document).on('click', '#guardarCamposClientes', function(e){
            e.preventDefault();
            
            let grabar = true;
    
            let nombre = $("#nombreCliente").val();
            let apellido = $("#apellidoCliente").val();
            let email = $("#emailCliente").val();
            let observaciones = $("#observacionesCliente").val();
            let grupo = $("#grupoCamposCliente").val();
    
    
            $("#errNombre").attr('hidden', '');
            $("#errApellido").attr('hidden', '');
            $("#errEmail").attr('hidden', '');
            $("#errEmail2").attr('hidden', '');
            $("#errObservaciones").attr('hidden', '');
            $("#errGrupo").attr('hidden', '');
    
    
    
            if(nombre.trim().length == 0){
                $("#errNombre").removeAttr('hidden');
                grabar = false;
            }
            if(apellido.trim().length == 0){
                $("#errApellido").removeAttr('hidden');
                grabar = false;
            }
            if(email.trim().length == 0){
                $("#errEmail").removeAttr('hidden');
                grabar = false;
            }else {
                //validar el correo
                const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if(!re.test(email.toLowerCase())){
                    $("#errEmail2").removeAttr('hidden');
                    grabar = false;
                }
            }
            
            if(observaciones.trim().length == 0){
                $("#errObservaciones").removeAttr('hidden');
                grabar = false;
            }
            if(grupo == 0){
                $("#errGrupo").removeAttr('hidden');
                grabar = false;
            }

            if(grabar){
                $.ajax({
                    method: 'POST',
                    dataType: 'html',
                    url: 'controllers/clientes/guardar',
                    data: {nombre: nombre, apellido: apellido, email: email, grupo: grupo, observaciones: observaciones},
                    success: function(data) {         
                        data = JSON.parse(data);
                        if(data.status){
                            $("#messageType").removeClass('bg-danger');
                            $("#messageType").addClass('bg-success');
                        }else{
                            $("#messageType").removeClass('bg-success');
                            $("#messageType").addClass('bg-danger');
                        }
                        $("#messageResult").empty();
                        $("#messageResult").append(data.message);
                        $(".toast").toast('show');
                        $("#clientes").trigger('click');
                        
                    }
                });
            }
    
        });

     $(document).on('click', '#guardarCambiosCamposClientes', function(e){
            e.preventDefault();
            
            let grabar = true;
            let idCliente = $("#idCliente").val();
            let nombre = $("#nombreCliente").val();
            let apellido = $("#apellidoCliente").val();
            let email = $("#emailCliente").val();
            let observaciones = $("#observacionesCliente").val();
            let grupo = $("#grupoCamposCliente").val();
    
    
            $("#errNombre").attr('hidden', '');
            $("#errApellido").attr('hidden', '');
            $("#errEmail").attr('hidden', '');
            $("#errEmail2").attr('hidden', '');
            $("#errObservaciones").attr('hidden', '');
            $("#errGrupo").attr('hidden', '');
    
    
    
            if(nombre.trim().length == 0){
                $("#errNombre").removeAttr('hidden');
                grabar = false;
            }
            if(apellido.trim().length == 0){
                $("#errApellido").removeAttr('hidden');
                grabar = false;
            }
            if(email.trim().length == 0){
                $("#errEmail").removeAttr('hidden');
                grabar = false;
            }else {
                //validar el correo
                const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if(!re.test(email.toLowerCase())){
                    $("#errEmail2").removeAttr('hidden');
                    grabar = false;
                }
            }
            
            if(observaciones.trim().length == 0){
                $("#errObservaciones").removeAttr('hidden');
                grabar = false;
            }
            if(grupo == 0){
                $("#errGrupo").removeAttr('hidden');
                grabar = false;
            }

            if(grabar){
                $.ajax({
                    method: 'POST',
                    dataType: 'html',
                    url: 'controllers/clientes/guardar_cambios',
                    data: {idCliente: idCliente, nombre: nombre, apellido: apellido, email: email, grupo: grupo, observaciones: observaciones},
                    success: function(data) {         
                        data = JSON.parse(data);
                        if(data.status){
                            $("#messageType").removeClass('bg-danger');
                            $("#messageType").addClass('bg-success');
                        }else{
                            $("#messageType").removeClass('bg-success');
                            $("#messageType").addClass('bg-danger');
                        }
                        $("#messageResult").empty();
                        $("#messageResult").append(data.message);
                        $(".toast").toast('show');
                        $("#clientes").trigger('click');
                        
                    }
                });
            }
    
        });
        
        
    
    
});