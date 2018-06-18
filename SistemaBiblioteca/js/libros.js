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
    
    $("#btnCancelar").on("click", function(){
        $('.modal-body input').val("");
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
    
    $('#consultar').click(function (){
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
                    $.each(data, function(key, value){
                        $("#grillaLibro").append('<tr>'
                        +'<td>'+value.isbn+'</td>'
                        +'<td>'+value.titulo+'</td>'
                        +'<td>'+value.autor+'</td>'
                        +'<td>'+value.editorial+'</td>'
                        +'<td>'+value.anno+'</td>'
                        +'<td>'+value.cantidad+'</td>'
                        +'<td>'+value.categoria+'</td>'
                        +'<td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalNuevoPrestamo">Prestar</button>'
                        +'<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalModificar">Modificar</button>'
                        +'<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDesactivar">Eliminar</button>'
                        +'</td></tr>');   
                    });
                }
            });
            break;
                default:
                break;
       }


   });
   
   $('#cmboBuscar').change(function(){
      
       var $cmboBuscar = $('#cmboBuscar');
       var $txtBuscar = $('#txtBuscar');
       var $btnBuscar = $('#consultar');
       
       if($cmboBuscar.val() !== ""){
           
           $txtBuscar.removeAttr('disabled');
           return;
         
       }else{
           $txtBuscar.attr('disabled','true');
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
   
   
   
  
   
});

