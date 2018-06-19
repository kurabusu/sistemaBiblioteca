$(document).ready(function () {
    let lista = [];
    let listaLibros = [];
    let listaUsuarios = [];
    let prestamoElim = 0;
    
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
   
    $("#btnBuscarUsuario").on("click", function(){
        console.log("----- listar usuarios -------")
        busq = $("#txtBuscarUsuario").val();
        $("#tableBuscarUsuario .grilla").html("");
        
        $.ajax({
            url : "php/controladores/PersonaObtenerListado.php",
            method: "GET",
            dataType: 'json',
            data:{
                clave: busq
            },
            success: function (data, textStatus, jqXHR) {
                arr = data;
                listaUsuarios = arr;
                $.each(arr, function(index, value){
                    $("#tableBuscarUsuario .grilla").append('<tr>'
                            + '<td>'+value.rut+'</td>'
                            + '<td>'+value.nombres+'</td>'
                            + '<td>'+value.apellidos+'</td>'
                            + '<td>'+value.email+'</td>'
                            + '<td>'
                            + '<button type="button" class="btn btn-info btnSelUsuario" attr-index="'+index+'"  data-dismiss="modal">Seleccionar</button>'
                            + '</td>'
                            + '</tr>')
                })
                
                $(".btnSelUsuario").on("click", function () {
                    index = $(this).attr("attr-index");
                    nombre = listaUsuarios[index].nombres+" "+listaUsuarios[index].apellidos;
                    $("#modalNuevoPrestamo #mnpUsuario").val(nombre);
                    $("#modalNuevoPrestamo #mnpUsuario").attr("attr-id", listaUsuarios[index].id);
                    
                    
                    $("#modalBuscarUsarios").modal("hide");
                });
                
            }
        })
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
                        + '<button type="button" class="btn btn-info btnSelLibro" attr-index="'+index+'" data-dismiss="modal">Seleccionar</button>'
                        + '</td>'
                        + '</tr>');
                });
                
                $(".btnSelLibro").on("click", function () {
                    index = $(this).attr("attr-index");
                    nombre = listaLibros[index].titulo;
                    $("#modalNuevoPrestamo #mnpLibro").val(nombre);
                    $("#modalNuevoPrestamo #mnpLibro").attr("attr-id", listaLibros[index].id );
                    
                    $("#modalBuscarLibro").modal("hide");
                    
                });
            }
        });
    })
    
    $("#btnGuardarNuevoPrestamo").on("click", function () {
        //data-dismiss="modal" data-toggle="modal" data-target="#modalPrestamoMensaje"
        var v = $("#formNuevoPrestamo").valid();
        if(!v){
            return false;
        }
        
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
        });
    });
   
    $("#btnValidarDevolver").on("click", function () {
        id = $(this).attr("attr-id");
        $.ajax({
            url: "php/controladores/prestamoDevolver.php",
            method: "DELETE",
            dataType: 'json',
            data: {
                prestamo: id
            },
            success: function (data, textStatus, jqXHR) {
                arr = data;
                if(arr.resultado > 0){
                    $("#modalMensajes .mensaje").html("Se ha procesado correctamente la devolución del libro.");
                    $("#modalMensajes").modal("show"); 
                    $("#modalValidacionDevolver").modal("hide");
                    listar();
                }else{
                    $("#modalMensajes .mensaje").html("Ocurrio un problema con el procesado. " + arr.resultado);
                    $("#modalMensajes").modal("show"); 
                }
                console.log(data);
            }
        })
    });
   
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
                
                $(".btnDevolverLibro").on("click", function () {
                    index= $(this).attr("attr-index");
                    $("#btnValidarDevolver").attr("attr-id",lista[index].id);
                    $("#modalValidacionDevolver").modal("show");
                });
            }
        });
    }
    
    $('#modalValidacionDevolver').on('hidden.bs.modal', function (e) {
        $("#btnValidarDevolver").removeAttr("attr-id");
    });
    
})