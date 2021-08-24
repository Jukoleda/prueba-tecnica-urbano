$(function(){
    //grupos
    //vista ListadoGrupoClientes.php
    $(document).on('click', '#nuevoGrupo', function(){
        $.ajax({
            method: 'POST',
            dataType: 'html',
            url: 'controllers/grupos/agregar',
            success: function(data) {                
                $("#main").empty();
                $("#main").append(data);
            }
            
        });
    });

    $(document).on('click', '.editarGrupo', function(){
        let idGrupo = $(this).data('idgrupo');

        $.ajax({
            method: 'POST',
            dataType: 'html',
            url: 'controllers/grupos/editar',
            data: {idGrupo: idGrupo},
            success: function (data) {
                $('#main').empty();
                $('#main').append(data);
            }
        });
    });

    $(document).on('click', '.eliminarGrupo', function(){
        if (confirm("¿Desea eliminar el grupo? Se eliminarán los clientes relacionados al mismo") == true) {
 
            let idGrupo = $(this).data('idgrupo');
            $.ajax({
                method: 'POST',
                dataType: 'html',
                url: 'controllers/grupos/eliminar',
                data: {idGrupo: idGrupo, estado: 2},
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
                    $("#grupos").trigger('click');
                    
                }
            });
         } 
     });

    //vista CamposGruposClientes.php
    $(document).on('click', '#volverCamposGrupoClientes', function(){
        $.ajax({
            method: 'POST',
            dataType: 'html',
            url: 'controllers/grupos/listar',
            success: function(data) {                
                $("#main").empty();
                $("#main").append(data);
            }
            
        });
    });
    
    $(document).on('keyup', '#filtroListadoGrupos', function(){
        let filtro = $("#filtroListadoGrupos").val();

        $.ajax({
            method: 'POST',
            dataType: 'html',
            url: 'controllers/grupos/listar',
            data: {nombre: filtro},
            success: function(data) {                
                $("#main").empty();
                $("#main").append(data);
                $("#filtroListadoGrupos").val(filtro);
                $("#filtroListadoGrupos").focus();

            }
            
        });
    });

    $(document).on('click', '#limpiarBuscadorListadoGrupos', function(){
        $.ajax({
            method: 'POST',
            dataType: 'html',
            url: 'controllers/grupos/listar',
            success: function(data) {                
                $("#main").empty();
                $("#main").append(data);
            }
            
        });
    });

    $(document).on('click', '#guardarCamposGrupoClientes', function(e){
        e.preventDefault();
        
        let grabar = true;
        let nombre = $("#nombreGrupo").val();
        

        $("#errNombreGrupo").attr('hidden', '');
        
        if(nombre.trim().length == 0){
            $("#errNombreGrupo").removeAttr('hidden');
            grabar = false;
        }
        
    
        if(grabar){
            $.ajax({
                method: 'POST',
                dataType: 'html',
                url: 'controllers/grupos/guardar',
                data: {nombre: nombre},
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
                    $("#grupos").trigger('click');
                    
                }
            });
        }
    });

    $(document).on('click', '#guardarCambiosCamposGrupoClientes', function(e){
        e.preventDefault();
        
        let grabar = true;
        let idGrupo = $("#idGrupo").val();
        let nombre = $("#nombreGrupo").val();
        


        $("#errNombreGrupo").attr('hidden', '');
      
        if(nombre.trim().length == 0){
            $("#errNombreGrupo").removeAttr('hidden');
            grabar = false;
        }
       
        
        if(grabar){
            $.ajax({
                method: 'POST',
                dataType: 'html',
                url: 'controllers/grupos/guardar_cambios',
                data: {idGrupo: idGrupo, nombre: nombre},
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
                    $("#grupos").trigger('click');
                    
                }
            });
        }

    });
    
});