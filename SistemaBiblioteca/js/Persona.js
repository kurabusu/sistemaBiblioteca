function ModPer(id){
    console.log("Desplegando información de usuario a modificar de ID " + id);
    $.ajax({
        url: "php/controladores/PersonaObtenerPorId.php",
        method: 'GET',
        dataType: 'json',
        data: {'id':id},
        success: function(data, textStatus, jqXHR){
            console.log(data);
            $.each(data,function(key, value){
              $('#idm').val(value.id);
              $('#rutm').val(value.rut);
              $('#nombresm').val(value.nombres);
              $('#apellidosm').val(value.apellidos);
              $('#telefonom').val(value.telefono);
              $('#emailm').val(value.email);
              $('#tipoperfilm option[value="'+value.perfil+'"]').prop("selected",true);
            })
        }
    })
}

$(document).ready(function(){
    var $comboPerfil = $('#tipoperfil');
    var $comboPerfil2 = $('#tipoperfilm');
    //Obtener listado de perfiles de sistema
    $.ajax({
        url: "php/controladores/ObtenerPerfiles.php",
        method: 'GET',
        dataType: 'json',
        success: function(data, textStatus, jqXHR){
            console.log("Cargando perfiles en combobox");
            console.log(data);
            $comboPerfil.find('option').remove();
            $comboPerfil.append('<option value="0">--- Seleccione tipo de perfil ---</option>');
            $comboPerfil2.find('option').remove();
            $comboPerfil2.append('<option value="0">--- Seleccione tipo de perfil ---</option>');
            $.each(data,function(key,value){
              $comboPerfil.append('<option value="' +  value.id + '">' + value.descripcion + '</option>');  
              $comboPerfil2.append('<option value="' +  value.id + '">' + value.descripcion + '</option>');  
            })
        }
                
    })
    
    $("#btnCancelarNuevo").click(function(){
        $("#rut").val("");
        $("#nombres").val("");
        $("#apellidos").val("");
        $("#telefono").val("");
        $("#email").val("");
        $("#clave1").val("");
        $("#clave2").val("");
        $("#tipoperfil").prop("selectedIndex",0).change();        
    })
    
    $("#btnaceptarnuevo").click(function(){
        $("#modalConfirmarNuevo").modal('hide');
        $("#modalAgregarNuevo").modal('hide');
        $("#rut").val("");
        $("#nombres").val("");
        $("#apellidos").val("");
        $("#telefono").val("");
        $("#email").val("");
        $("#clave1").val("");
        $("#clave2").val("");
        $("#tipoperfil").prop("selectedIndex",0).change();
    })
    
    $("#btnaceptarmodificar").click(function(){
        $("#modalConfirmarModificar").modal('hide');
        $("#modalModificar").modal('hide');
        BuscarUsuario();
    })
    
    $("#btnConfirmarModificar").click(function(){
        console.log("Actualizando información de persona");
        $.ajax({
            url: "php/controladores/PersonaActualizar.php",
            method: 'PUT',
            dataType: 'json',
            data: {'id' : $("#idm").val(),'nombres' : $("#nombresm").val(),
                'apellidos' : $("#apellidosm").val(), 'email' : $("#emailm").val(),
                'telefono' : $("#telefonom").val(), 'perfil' : $("#tipoperfilm").val()
            },
            success : function (data, textStatus, jqXHR){
                resultadofinal = data;
                if(resultadofinal["resultado"] == 0){
                    $("#modalModificarMensaje").modal('show');
                }else{
                    $("#modalMensajeErrores p").html(resultadofinal.resultado);
                    $("#modalMensajeErrores").modal('show');
                }
            }
            
        })
    })
    
    $("#btnConfirmarNuevo").click(function(){
        console.log("Guardando nueva persona");
        
        $.ajax({
            url: "php/controladores/PersonaNuevo.php",
            method: 'POST',
            dataType: 'json',
            data: {'rut' : $("#rut").val(),'nombres' : $("#nombres").val(),
            'apellidos' : $("#apellidos").val(), 'email' : $("#email").val(),
            'telefono' : $("#telefono").val(),'perfil' : $("#tipoperfil").val(),
            'password1' : $("#clave1").val(), 'password2' : $("#clave2").val()},
            success: function (data, textStatus, jqXHR) {
                console.log(data);
                resultadofinal = data;
                if (resultadofinal["resultado"] > 0){
                    $("#modalAgregarMensaje").modal('show');
                }else{
                    $("#modalMensajeErrores p").html(resultadofinal.resultado);
                    $("#modalMensajeErrores").modal('show');
                }
            }
        })
    })
    
    function BuscarUsuario(){

        var claveBusqueda = $.trim($("#txtBuscarPersona").val());
        
        if(claveBusqueda === ""){
            return;
        }
        
        console.log("Ejecutando búsqueda de usuarios con clave de búsqueda");
        var $grillaResultados = $('#grilla');
        $.ajax({
            url: "php/controladores/PersonaObtenerListado.php",
            method: 'GET',
            dataType: 'json',
            data: {'clave':claveBusqueda},
            success: function (data, textStatus, jqXHR){
                console.log(data);
                $grillaResultados.html("");
                $.each(data, function(key, value){
                    var estado;
                    if (value.estado==1){
                        estado="Activo";
                    }
                    if (value.estado==0){
                        estado="Desactivado";
                    }
                    if (value.estado==2){
                        estado="Bloqueado";
                    }
                    html = '<tr>'
                    + '<td>' + value.rut + '</td>'
                    + '<td>' + value.nombres + '</td>'
                    + '<td>' + value.apellidos+ '</td>'
                    + '<td>' + value.email + '</td>'
                    + '<td>' + value.telefono + '</td>'
                    + '<td>' + value.perfil.descripcion + '</td>'
                    + '<td>' + estado + '</td>'
                    + '<td><input class="btn btn-info" type="button" name="modificar" id="btnmodificar" data-toggle="modal" data-target="#modalModificar" value="Modificar" onClick="ModPer('+value.id+');">';
                    if (value.estado==1){
                        html+= '<input class="ml-2 btn btn-danger" type="button" name="desactivar" id="btndesactivar" value="Desactivar">'
                        + '<input class="ml-2 btn btn-warning" type="button" name="bloquear" id="btnbloquear" value="Bloquear">'
                    }else if (value.estado==2){
                        html+= '<input class="ml-2 btn btn-danger" type="button" name="activar" id="btnactivar" value="Activar">'
                        + '<input class="ml-2 btn btn-warning" type="button" name="desbloquear" id="btndesbloquear" value="Desbloquear">'                        
                    }else if (value.estado==0){
                        html+= '<input class="ml-2 btn btn-danger" type="button" name="activar" id="btnactivar" value="Activar">'
                        + '<input class="ml-2 btn btn-warning" type="button" name="bloquear" id="btnbloquear" value="Bloquear">'                        
                    }
                    html+="</td></tr>";
                    $grillaResultados.append(html);
                })
            }
        })        
    }
    $("#buscarPersona").click(function(){
        BuscarUsuario();
    })
})


