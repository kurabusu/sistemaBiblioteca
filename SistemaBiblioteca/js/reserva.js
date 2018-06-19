$(document).ready(function () {
    let lista = [];
    let listaLibros = [];
    let listaUsuarios = [];
    let reservaElim = 0;
    
    $("#consultar").on("click", function(){
        listar();
    });
   
    $("#btnGuardarNuevo").on("click", function () {
        var codigo = $("#txtCodigoN").val();
        var descripcion = $("#txtDescripcionN").val();
        
    });
    
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
                    $("#modalNuevoReserva #mnrUsuario").val(nombre);
                    $("#modalNuevoReserva #mnrUsuario").attr("attr-id", listaUsuarios[index].id);
                    
                    
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
                    $("#modalNuevoReserva #mnrLibro").val(nombre);
                    $("#modalNuevoReserva #mnrLibro").attr("attr-id", listaLibros[index].id );
                    
                    $("#modalBuscarLibro").modal("hide");
                    
                });
            }
        });
    })
    
    $("#btnNuevoPrestamo").on("click", function () {
        idPer = $("#mnpUsuario").attr("attr-id");
        idLibro = $("#mnpLibro").attr("attr-id");
        idReserva = $("#mnpReserva").attr("attr-id");
        
        $.ajax({
            url: "php/controladores/PrestamoNuevo.php",
            method: "POST",
            dataType: 'json',
            data: {
                persona: idPer,
                libro: idLibro, 
                reserva: idReserva 
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
    
    $("#btnGuardarNuevaReserva").on("click", function () {
        var v = $("#formNuevaReserva").valid();
        if(!v){
            return false;
        }
         
        idPer = $("#modalNuevoReserva #mnrUsuario").attr("attr-id");
        idLibro = $("#modalNuevoReserva #mnrLibro").attr("attr-id");
        
        $.ajax({
            url: "php/controladores/ReservaNuevo.php",
            method: "POST",
            dataType: 'json',
            data: {
                persona: idPer,
                libro: idLibro
            },
            success: function (data, textStatus, jqXHR) {
                arr = data;
                console.log(arr.resultado);
                if(arr.resultado > 0 ){
                    $("#modalMensajes .mensaje").html("Se ha ingresado la reserva.");
                    $("#modalMensajes").modal("show"); 
                    $("#modalNuevoReserva").modal("hide");
                    listar();
                    limpiar();
                }else{
                    $("#modalMensajes .mensaje").html("No se ha realizado el ingreso de la reserva. " + arr.resultado);
                    $("#modalMensajes").modal("show"); 
                }
            }
        });
    });
    
    $("#btnReservaCancelar").on("click", function () {
        if(reservaElim == 0){
            return;
        }
        idE = reservaElim;
        $.ajax({
            url: "php/controladores/ReservaEliminar.php",
            method: "DELETE",
            dataType: 'json',
            data: {
                reserva : idE
            },
            success: function (data, textStatus, jqXHR) {
                arr = data;
                if(arr.resultado > 0){
                    $("#modalReservaEliminar").modal("hide");
                    
                    $("#modalMensajes .mensaje").html("Se ha eliminado la reserva.");
                    $("#modalMensajes").modal("show"); 
                    listar();
                }else{
                    $("#modalMensajes .mensaje").html("No se ha realizado la eliminación de la reserva. "+ arr.resultado);
                    $("#modalMensajes").modal("show");  
                }
            }
        });
        
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
                    + '    <button type="button" class="btn btn-info btnReservaPrestamo" data-toggle="modal" attr-index="'+index+'" data-target="#modalNuevoPrestamo">Prestar</button>'
                    + '    <button type="button" class="btn btn-danger btnReservaCancelar" data-toggle="modal" attr-index="'+index+'" data-target="#modalReservaEliminar">Eliminar</button>'
                    + '</td></tr>');
                });
                
                $(".btnReservaCancelar").on("click", function () {
                    index = $(this).attr("attr-index");
                    reservaElim = lista[index].id;
                });
                
                $(".btnReservaPrestamo").on("click", function () {
                    index = $(this).attr("attr-index");
                    console.log(lista[index]);
                    nombre = lista[index]["persona"]["nombres"] +" "+ lista[index]["persona"]["apellido"];
                    
                    $("#mnpUsuario").val(nombre);
                    $("#mnpUsuario").attr("attr-id", lista[index]["persona"]["id"]);
                    $("#mnpLibro").val(lista[index]["libro"]["titulo"]);
                    $("#mnpLibro").attr("attr-id", lista[index]["libro"]["id"]);
                    
                    $("#mnpReserva").attr("attr-id", lista[index]["id"]);
                    
                });
            }
        });
    }
    
    function limpiar(){
        $("#modalNuevoReserva #mnrUsuario").removeAttr("attr-id");
        $("#modalNuevoReserva #mnrLibro").removeAttr("attr-id");
        $("#modalNuevoReserva #mnrUsuario").val("");
        $("#modalNuevoReserva #mnrLibro").val("");
        $("#tableBuscarLibro .grilla").html("");
        $("#tableBuscarUsuario .grilla").html("");
        listaLibros = [];
        listaUsuarios = [];
    }
    
    $('#modalReservaEliminar').on('hidden.bs.modal', function (e) {
        reservaElim = 0;
        console.log("limpienado reservaElim => " + reservaElim);
    });
    
    $('#modalNuevoPrestamo').on('hidden.bs.modal', function (e) {
        $("#mnpUsuario").val("");
        $("#mnpUsuario").removeAttr("attr-id");
        $("#mnpLibro").val("");
        $("#mnpLibro").removeAttr("attr-id");
    });
    
});