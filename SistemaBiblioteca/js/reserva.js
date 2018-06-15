$(document).ready(function () {
    var lista = [];
    
    $("#consultar").on("click", function(){
        listar();
    });
   
    $("#btnGuardarNuevo").on("click", function () {
        var codigo = $("#txtCodigoN").val();
        var descripcion = $("#txtDescripcionN").val();
        
    });
   
   
    function listar(){
        console.log("----- listar ---------");
        $("#grilla").html("");
        busq = $("#txtBuscar").val(); 
        
        $.ajax({
            url: "php/controladores/ReservaObtener.php", 
            method: "GET",
            dataType: "json",
            data:{
                'fechaReserva': busq,
                'libro': busq,
                'persona':busq
            },
            success: function (data, textStatus, jqXHR) {
                arr = data, //JSON.parse(data);
                lista = arr.resultado;
                $.each(arr.resultado, function(index, value){
                    $("#grilla").append('<tr>'
                    + '<td>'+value.persona.nombres+' '+value.persona.apellido+'</td>'
                    + '<td>'+value.libro.titulo+'</td>'
                    + '<td>'+value.fechaReserva+'</td>'
                    + '<td>'
                    + '    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalNuevoPrestamo">Prestar</button>'
                    + '    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalCancelar">Cancelar</button>'
                    + '</td>');
                });
            }
        })
    }
});