$(document).ready(function () {
    var lista = [];
    var listaLibros = [];
    
    $("#consultar").on("click", function(){
        listar();
    });
   
    $("#btnGuardarNuevo").on("click", function () {
        var codigo = $("#txtCodigoN").val();
        var descripcion = $("#txtDescripcionN").val();
        
    });
    
    $("#btnBuscarLibro").on("click", function () {
        console.log("----- listar libros ---------");
        busq = $("#txtBuscarLibro").val();
        $("#tableBuscarLibro .grilla").html("");
        
        $.ajax({
            url : "php/controladores/LibroObtener.php",
            method: "GET",
            dataType: "json",
            data: {
                'isbn': busq,
                'titulo': busq,
                'autor': busq
            },
            success: function (data, textStatus, jqXHR) {
                arr = data;
                listaLibros = arr.resultado;
                $.each(arr.resultado, function(index, value){
                    $("#tableBuscarLibro .grilla").append('<tr>'
                        + '<td>'+value.isbn+'</td>'
                        + '<td>'+value.titulo+'</td>'
                        + '<td>'+value.autor+'</td>'
                        + '<td>'+value.editorial+'</td>'
                        + '<td>'+value.año+'</td>'
                        + '<td>'
                        + '<button type="button" class="btn btn-info"  data-dismiss="modal">Seleccionar</button>'
                        + '</td>'
                        + '</tr>');
                })
            }
        })
        
    })
   
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