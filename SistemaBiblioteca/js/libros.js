$(document).ready(function(){
    var listaLibros=[];
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
    
    $("#btnGuardarLibro").on("click", function(){
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
    
    $("#btnGuardaCambio").on("click", function(){
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
   
   //busqueda y modificacion
   function busqueda(){
       $metodoBusqueda = $('#cmboBuscar').val();
       $palabraBusqueda = $('#txtBuscar').val();
       console.log("Buscando Libros segun clave");
       $("#grillaLibro").html("");
       switch($metodoBusqueda){
           case"1":
                $.ajax({
                    "url": "php/controladores/LibroObtener.php",
                    "method": "GET",
                    "dataType": "JSON",
                    "data" : {
                        "isbn": $palabraBusqueda
                    },
                    success: function (data, textStatus, jqXHR) {
                        console.log(data);
                        arr = data;
                        listaLibros= arr.resultado;
                        $.each(arr.resultado, function(key, value){
                            $("#grillaLibro").append('<tr>'
                            +'<td>'+value.isbn+'</td>'
                            +'<td>'+value.titulo+'</td>'
                            +'<td>'+value.autor+'</td>'
                            +'<td>'+value.editorial+'</td>'
                            +'<td>'+value.año+'</td>'
                            +'<td>'+value.cantidad+'</td>'
                            +'<td>'+value.categoria.descripcion+'</td>'
                            +'<td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalNuevoPrestamo" id="btnPrestamo" >Prestamo</button>'
                            +'<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalModificar" id="btnModi" attr-index="'+key+'">Modificar</button>'
                            +'<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDesactivar" id="btnEliminar" >Eliminar</button>'
                            +'</td></tr>');   
                        });
                        
                        $('#btnModi').on("click", function(){
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
                    }
                    
                    
                });
            break;
            
           case"2":
                $.ajax({
                    "url": "php/controladores/LibroObtener.php",
                    "method": "GET",
                    "dataType": "JSON",
                    "data" : {
                        "titulo": $palabraBusqueda
                    },
                    success: function (data, textStatus, jqXHR) {
                        console.log(data);
                        arr = data;
                        listaLibros= arr.resultado;
                        $.each(arr.resultado, function(key, value){
                            $("#grillaLibro").append('<tr>'
                            +'<td>'+value.isbn+'</td>'
                            +'<td>'+value.titulo+'</td>'
                            +'<td>'+value.autor+'</td>'
                            +'<td>'+value.editorial+'</td>'
                            +'<td>'+value.año+'</td>'
                            +'<td>'+value.cantidad+'</td>'
                            +'<td>'+value.categoria.descripcion+'</td>'
                            +'<td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalNuevoPrestamo" id="btnPrestamo" >Prestamo</button>'
                            +'<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalModificar" id="btnModi" attr-index="'+key+'">Modificar</button>'
                            +'<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDesactivar" id="btnEliminar" >Eliminar</button>'
                            +'</td></tr>');   
                        });
                        
                        $('#btnModi').on("click", function(){
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
                    }
                });
            break;
                
           case"3":
                $.ajax({
                    "url": "php/controladores/LibroObtener.php",
                    "method": "GET",
                    "dataType": "JSON",
                    "data" : {
                        "autor": $palabraBusqueda
                    },
                    success: function (data, textStatus, jqXHR) {
                        console.log(data);
                        arr = data;
                        listaLibros= arr.resultado;
                        $.each(arr.resultado, function(key, value){
                            $("#grillaLibro").append('<tr>'
                            +'<td>'+value.isbn+'</td>'
                            +'<td>'+value.titulo+'</td>'
                            +'<td>'+value.autor+'</td>'
                            +'<td>'+value.editorial+'</td>'
                            +'<td>'+value.año+'</td>'
                            +'<td>'+value.cantidad+'</td>'
                            +'<td>'+value.categoria.descripcion+'</td>'
                             +'<td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalNuevoPrestamo" id="btnPrestamo" >Prestamo</button>'
                            +'<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalModificar" id="btnModi" attr-index="'+key+'">Modificar</button>'
                            +'<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDesactivar" id="btnEliminar" >Eliminar</button>'
                            +'</td></tr>');   
                        });
                        
                        $('#btnModi').on("click", function(){
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
                    }
                });
            break;
            
           case"4":
                $.ajax({
                     "url": "php/controladores/LibroObtener.php",
                     "method": "GET",
                     "dataType": "JSON",
                     "data" : {
                         "editorial": $palabraBusqueda
                     },
                     success: function (data, textStatus, jqXHR) {
                         console.log(data);
                         arr = data;
                         listaLibros= arr.resultado;
                         $.each(arr.resultado, function(key, value){
                             $("#grillaLibro").append('<tr>'
                             +'<td>'+value.isbn+'</td>'
                             +'<td>'+value.titulo+'</td>'
                             +'<td>'+value.autor+'</td>'
                             +'<td>'+value.editorial+'</td>'
                             +'<td>'+value.año+'</td>'
                             +'<td>'+value.cantidad+'</td>'
                             +'<td>'+value.categoria.descripcion+'</td>'
                             +'<td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalNuevoPrestamo" id="btnPrestamo" >Prestamo</button>'
                            +'<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalModificar" id="btnModi" attr-index="'+key+'">Modificar</button>'
                            +'<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDesactivar" id="btnEliminar" >Eliminar</button>'
                            +'</td></tr>');    
                         });
                         
                         $('#btnModi').on("click", function(){
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
                     }
                 });
            break;
            
            default:
            break;
       }
   }   
});

