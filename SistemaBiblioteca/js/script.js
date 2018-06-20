$(document).ready(function(){
    $.ajaxSetup({ 
        beforeSend:function(){
            $("#loading").show();
        }, 
        complete:function () {
            $("#loading").hide();
       }
    });
    
    
    $('.modalEditar, .modalNuevo').on('hidden.bs.modal', function (e) {
        $(".modalEditar form, .modalNuevo form")[0].reset();
    })
    
    $("#btnaceptarmisdatos").click(function(){
        $("#modalModificarDatosMensaje").modal('hide');
        location.reload();
    })
    
    $("#btnConfirmarCambioDatos").click(function() {
        console.log("Actualizando información del usuario logeado.");
        $.ajax({
            url: "php/controladores/PersonaActualizar.php",
            method: 'PUT',
            dataType: 'json',
            data: {'id' : $("#idusuariologin").val(),'nombres' : $("#nombresusuario").val(),
                'apellidos' : $("#apellidosusuario").val(), 'email' : $("#emailusuario").val(),
                'telefono' : $("#telefonousuario").val(), 'perfil' : $("#perfilusuariologin").val(),
                'actualizarsesion' : "si"
            },
            success : function (data, textStatus, jqXHR){
                resultadofinal = data;
                if(resultadofinal["resultado"] == 0){
                    $("#modalModificarDatosMensaje").modal('show');
                }else{
                    $("#modalMensajeErrores p").html(resultadofinal.resultado);
                    $("#modalMensajeErrores").modal('show');
                }
            }

        })  
    })
    
   
});

    
