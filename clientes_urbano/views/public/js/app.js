$(function(){


    $(document).on('click', "#home", function(){
        $("#grupos").removeClass('active');
        $("#clientes").addClass('active');
        $.ajax({
            method: 'POST',
            dataType: 'html',
            url: 'controllers/clientes/listar',
            success: function (data) {
                $('#main').empty();
                $('#main').append(data);
            }
        });
    });

    $(document).on('click', "#grupos", function(){
        $("#clientes").removeClass('active');
        $(this).addClass('active');
        $.ajax({
            method: 'POST',
            dataType: 'html',
            url: 'controllers/grupos/listar',
            success: function (data) {
                $('#main').empty();
                $('#main').append(data);
            }
        });
    });

    $(document).on('click', "#clientes", function(){
        $("#grupos").removeClass('active');
        $(this).addClass('active');
        $.ajax({
            method: 'POST',
            dataType: 'html',
            url: 'controllers/clientes/listar',
            success: function (data) {
                $('#main').empty();
                $('#main').append(data);
            }
        });
    });

    
});