$(document).ready(function () {
    
    
    $("#consultar").on("click", function(){
        listar();
    });
   
   
    $("#btnNuevoPrestamo").on("click", function () {
        idPer = $("#mnpUsuario").attr("attr-id");
        idLibro = $("#mnpLibro").attr("attr-id");
        
        $.ajax({
            url: "php/controladores/PrestamoNuevo.php",
            method: "POST",
            dataType: 'json',
            data: {
                persona: idPer,
                libro: idLibro
            },
            success: function (data, textStatus, jqXHR) {
                arr = data;
                if(arr.resultado > 0){
                    $("#modalMensajes .mensaje").html("Se ha ingresado el prestamo.");
                    $("#modalMensajes").modal("show"); 
                    
                    $("#modalNuevoPrestamo").modal("hide");
                    listar();
                }else{
                    $("#modalMensajes .mensaje").html("No se ha ingresado el prestamo. " + arr.resultado);
                    $("#modalMensajes").modal("show"); 
                }
            }
        })
    })
   
    function listar(){
        console.log("----- listar ---------");
        $("#grilla").html("");
        busq = $("#txtBuscar").val(); 
        
        $.ajax({
            url: "php/controladores/PrestamoObtener.php", 
            method: "GET",
            dataType: "json",
            data:{
                'libro': busq,
                'persona':busq
            },
            success: function (data, textStatus, jqXHR) {
                arr = data, //JSON.parse(data);
                lista = arr.resultado;
                $.each(arr.resultado, function(index, value){
                    $("#grilla").append('<tr>'
                    + '<td>'+value["persona"]["nombres"]+' '+value["persona"]["apellido"]+'</td>'
                    + '<td>'+value["libro"]["titulo"]+'</td>'
                    + '<td>'+value["fechaEntrega"]+'</td>'
                    + '<td>'
                    + '<button type="button" class="btn btn-danger btnDevolverLibro" data-toggle="modal" attr-index="'+index+'" data-target="#modalDevolverLibro">Devolver Libro</button>'
                    + '</td</tr>');
                });
            }
        });
    }
})