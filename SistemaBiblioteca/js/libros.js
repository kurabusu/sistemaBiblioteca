$(document).ready(function(){
    var listaLibros = [];
    var listaUsuarios = [];
    var $cmboBox = $('#categoria');                

    jqXmlHttpRequest = $.getJSON("php/controladores/CategoriaObtenerListado.php", function (respuestaJSON) {      

        $cmboBox.find('option').remove();
        $cmboBox.append('<option value="" >--Seleccionar Categoria--</option>');

        $.each(respuestaJSON, function (key, value) {
            $cmboBox.append('<option value="' + value.id + '">' + value.descripcion + '</option>');
        });
    });
    
    var $cmboBox2 = $('#categoriaM');                

    jqXmlHttpRequest = $.getJSON("php/controladores/CategoriaObtenerListado.php", function (respuestaJSON) {      

        $cmboBox2.find('option').remove();
        $cmboBox2.append('<option value="" >--Seleccionar Categoria--</option>');

        $.each(respuestaJSON, function (key, value) {
            $cmboBox2.append('<option value="' + value.id + '">' + value.descripcion + '</option>');
        });
    });  
    
    
    $("#btnCancelar").on("click", function(){
        $('.modal-body input').val("");
    });
    
    $("#btnCancelarM").on("click", function(){
        $('.modal-body input').val("");
    });
    
    $("#btnaceptarnuevo").click(function(){
       $("#modalNuevo").modal('hide');
       $('.modal-body input').val("");
    });
    
    $("#btnaceptarCambios").click(function(){
       $("#modalModificar").modal('hide');
       $('.modal-body input').val("");   
    });
    
    $("#btnModifi").click(function(){
        $("#modalConfirmarNuevo").modal('show');
    });
    
    /*$("#btnCierra").click(function(){
        $("#modal")
    });*/
    
    $("#btnGuardarLibro").on("click", function(){
        var v = $("#formLibroUsuario").valid();
        if(!v){
            return false;
        }
        
        console.log("Ingresando nuevo Libro");
        $.ajax({
            url: "php/controladores/LibroNuevo.php",
            method: "POST",
            dataType: "JSON",
            data: { 'isbn':$("#isbn").val(), 'titulo': $("#titulo").val(),
                'autor':$("#autor").val(), 'editorial':$("#editorial").val(),
                'anno':$("#anno").val(), 'categoria':$("#categoria").val(), 'cantidad':$("#cantidad").val()
            },
            success: function (data, textStatus, jqXHR) {
                console.log(data);
                $("#modalAgregarMensaje").modal('show');
            }
        });
    });
    
    $("#btneliminaLibro").on("click", function(){
        console.log("Eliminando Libro");
        $.ajax({
            url: "php/controladores/LibroEliminar.php",
            method: "DELETE",
            dataType: "JSON",
            data: {
                'id': $("#idE")
            },
            success: function (data, textStatus, jqXHR) {
                arr = data;
                console.log(arr);
                if(arr.resultado === 1){
                    console.log("bien");
                    $("#modalDesactivarMensaje").modal('show');   
                }else{
                    console.log("mal");
                    $("#modalMensajeErrores p").html(arr.resultado);
                    $("#modalMensajeErrores").modal('show');
               }
            }
        });
    });
    
    $("#btnGuardaCambio").on("click", function(){
        var v = $("#formLibroUsuario").valid();
        if(!v){
            return false;
        }
        console.log("Modificando Información Libro");
        $.ajax({
            url: "php/controladores/LibroModificar.php",
            method: "PUT",
            dataType: "JSON",
            data: { 'id': $("#idM").val(), 'isbn':$("#isbnM").val(), 'titulo': $("#tituloM").val(),
                'autor':$("#autorM").val(), 'editorial':$("#editorialM").val(),
                'anno':$("#annoM").val(), 'categoria':$("#categoriaM").val(), 'cantidad':$("#cantidadM").val()
            },
            success : function (data, textStatus, jqXHR) {
                arr = data;
                console.log(arr);
                if(arr.resultado === 1){
                    console.log("bien");
                    $("#modalModificarMensaje").modal('show');   
                }else{
                    console.log("mal");
                    $("#modalMensajeErrores p").html(arr.resultado);
                    $("#modalMensajeErrores").modal('show');
               }
            }
        });
    });
    
   $('#consultar').click(function (){
       busqueda();
   });
   
    $('#cmboBuscar').change(function(){
      
        var $cmboBuscar = $('#cmboBuscar');
        var $txtBuscar = $('#txtBuscar');
        var $btnBuscar = $('#consultar');
       
        if($cmboBuscar.val() !== ""){
           
            $txtBuscar.removeAttr('disabled');
            $txtBuscar.val("");
            return;
         
        }else{
            $txtBuscar.attr('disabled','true');
            $txtBuscar.val("");
            $btnBuscar.attr('disabled', 'true');
        }
    });
   
    $('#txtBuscar').on('keyup',function(){
       var $txtBuscar = $('#txtBuscar');
       var $btnBuscar = $('#consultar');
       
       if($txtBuscar.val() !==""){
            $btnBuscar.removeAttr('disabled');
       }else{
           $btnBuscar.attr('disabled', 'true');
       }
    });
   
    $("#btnNuevoPrestamo").on("click", function () {
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
        })
        
    })
   
    $("#btnBuscarUsuario").on("click", function () {
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
    
    //busqueda, modificacion, prestamo y eliminar
    function busqueda(){
       idPe = $("#btnMisDatos").attr("attr-perfil");
       $metodoBusqueda = $('#cmboBuscar').val();
       $palabraBusqueda = $('#txtBuscar').val();
       console.log("Buscando Libros segun clave");
       $("#grillaLibro").html("");
       d = {};
       switch($metodoBusqueda){
            case"1":
                d = {"isbn": $palabraBusqueda};
                break;
                
            case"2":
                d = {"titulo": $palabraBusqueda};
                break;
                
            case"3":
               d = {"autor": $palabraBusqueda };
                break;
            
            case"4":
                d = { "editorial": $palabraBusqueda };
                break;
            default:
                return false;
                break;
       }
       
       $.ajax({
            "url": "php/controladores/LibroObtener.php",
            "method": "GET",
            "dataType": "JSON",
            "data" : d,
            success: function (data, textStatus, jqXHR) {
                console.log(data);
                arr = data;
                listaLibros= arr.resultado;
                $.each(arr.resultado, function(key, value){
                    h = '<tr>'
                    +'<td>'+value.isbn+'</td>'
                    +'<td>'+value.titulo+'</td>'
                    +'<td>'+value.autor+'</td>'
                    +'<td>'+value.editorial+'</td>'
                    +'<td>'+value.año+'</td>'
                    +'<td>'+value.cantidad+'</td>'
                    +'<td>'+value.categoria.descripcion+'</td>'
                    +'<td>';
                    if(idPe == 1 || idPe == 2){
                        h += '<button type="button" class="btn btn-info btnPrestamo" data-toggle="modal" data-target="#modalNuevoPrestamo" attr-index="'+key+'" >Prestamo</button>'
                        +'<button type="button" class="btn btn-warning ml-2 mr-2 btnModi" data-toggle="modal" data-target="#modalModificar" attr-index="'+key+'">Modificar</button>'
                    }
                    h +='</td></tr>';  
                    $("#grillaLibro").append(h);
                }); 

                $('.btnModi').on("click", function(){
                    var x = $(this).attr("attr-index");
                    console.log(listaLibros[x]);
                    $("#idM").val(listaLibros[x]["id"]);
                    $("#isbnM").val(listaLibros[x]["isbn"]);
                    $("#tituloM").val(listaLibros[x]["titulo"]);
                    $("#autorM").val(listaLibros[x]["autor"]);
                    $("#editorialM").val(listaLibros[x]["editorial"]);
                    $("#annoM").val(listaLibros[x]["año"]);
                    //$("#categoriaM").val(listaLibros[x]["categoria.d"]);
                    $("#cantidadM").val(listaLibros[x]["cantidad"]);
                });
                
                $(".btnPrestamo").on("click", function () {
                    var x = $(this).attr("attr-index");
                    console.log(listaLibros[x]);
                    $("#mnpLibro").val(listaLibros[x].titulo);
                    $("#mnpLibro").attr("attr-id", listaLibros[x].id);
                });
                
            }
        });
   }   
});

