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

function ModClave(id){
    $.ajax({
        url: "php/controladores/PersonaObtenerPorId.php",
        method: 'GET',
        dataType: 'json',
        data: {'id':id},
        success: function(data, textStatus, jqXHR){
            $.each(data,function(key,value){
                $("#idusuario").val(value.id);
                $("#modalCambiarClave h5").html("Cambiar clave a "+value.nombres+" "+value.apellidos);
            })
        }
            
    })
}

function Desactivar(id){
    $.ajax({
      url: "php/controladores/PersonaObtenerPorId.php",
      method: 'GET',
      dataType: 'json',
      data: {'id':id},
      success: function(data, textStatus, jqXHR){
          $.each(data, function(key,value){
              $("#usuariodesactivar").val(value.id);
              $("#modalConfirmarDesactivacion p").html("¿Est&aacute; seguro de desactivar al usuario "+value.nombres+" "+value.apellidos+"?");
          })
      }
    })
}

function Activar(id){
    $.ajax({
      url: "php/controladores/PersonaObtenerPorId.php",
      method: 'GET',
      dataType: 'json',
      data: {'id':id},
      success: function(data, textStatus, jqXHR){
          $.each(data, function(key,value){
              $("#usuarioactivar").val(value.id);
              $("#modalConfirmarActivacion p").html("¿Est&aacute; seguro de activar al usuario "+value.nombres+" "+value.apellidos+"?");
          })
      }
    })
}

function Bloquear(id){
    $.ajax({
        url: "php/controladores/PersonaObtenerPorId.php",
        method: 'GET',
        dataType: 'json',
        data: {'id' : id},
        success: function(data, textStatus, jqXHR){
            $.each(data, function(key,value){
                $("#usuariobloquear").val(value.id);
                $("#modalConfirmarBloqueo p").html("¿Est&aacute; seguro de bloquear al usuario "+value.nombres+" "+value.apellidos+"?");                
            })
        }
    })
}

function Desbloquear(id){
    $.ajax({
        url: "php/controladores/PersonaObtenerPorId.php",
        method: 'GET',
        dataType: 'json',
        data: {'id' : id},
        success: function(data, textStatus, jqXHR){
            $.each(data, function(key, value){
                $("#usuariodesbloquear").val(value.id);
                $("#modalConfirmarDesbloqueo p").html("¿Est&aacute; seguro de desbloquear al usuario "+value.nombres+" "+value.apellidos+"?");                
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
    
    $("#btnaceptardesactivacion").click(function(){
        $("#modalMensajeDesactivar").modal('hide');
        $("#modalConfirmarDesactivacion").modal('hide');
        BuscarUsuario();
    })
    
    $("#btnaceptarclave").click(function(){
        $("#modalConfirmarClave").modal('hide');
        $("#modalCambiarClave").modal('hide');
        $("#nuevapassword1").val("");
        $("#nuevapassword2").val("");
    })
    
    
    $("#btnConfirmarDesbloqueo").click(function() {
        console.log("Desbloqueando usuario " + $("#usuariodesbloquear").val());
        $.ajax({
            url: "php/controladores/PersonaCambiarEstado.php",
            method: 'PUT',
            dataType: 'json',
            data: {'idusuario' : $("#usuariodesbloquear").val(), 'estado' : 1},
            success: function (data, textStatus, jqXHR){
                resultado = data;
                if(resultado["resultado"]==0){
                    $("#modalMensajeEstado h5").html("Desbloquear usuario");
                    $("#modalMensajeEstado p").html("Se ha desbloqueado al usuario correctamente.");
                    $("#modalMensajeEstado").modal('show');
                }
            }
        })
    })
    
    $("#btnConfirmarBloqueo").click(function() {
        console.log("Bloqueando usuario " + $("#usuariobloquear").val());
        $.ajax({
            url: "php/controladores/PersonaCambiarEstado.php",
            method: 'PUT',
            dataType: 'json',
            data: {'idusuario' : $("#usuariobloquear").val(), 'estado' : 2},
            success: function (data, textStatus, jqXHR){
                resultado = data;
                if(resultado["resultado"]==0){
                    $("#modalMensajeEstado h5").html("Bloquear usuario");
                    $("#modalMensajeEstado p").html("Se ha bloqueado al usuario correctamente.");
                    $("#modalMensajeEstado").modal('show');
                }
            }
        })
    })
    
    $("#btnConfirmarActivacion").click(function(){
        console.log("Activando usuario " + $("#usuarioactivar").val());
        $.ajax({
            url: "php/controladores/PersonaCambiarEstado.php",
            method: 'PUT',
            dataType: 'json',
            data: {'idusuario' : $("#usuarioactivar").val(), 'estado' : 1},
            success: function (data, textStatus, jqXHR){
                resultado = data;
                if(resultado["resultado"]==0){
                    $("#modalMensajeEstado h5").html("Activar usuario");
                    $("#modalMensajeEstado p").html("Se ha activado al usuario correctamente.");
                    $("#modalMensajeEstado").modal('show');                    
                }
            }
        })
    })
    
    $("#btnConfirmarDesactivacion").click(function(){
        console.log("Desactivando usuario " + $("#usuariodesactivar").val());
        $.ajax({
            url: "php/controladores/PersonaCambiarEstado.php",
            method: 'PUT',
            dataType: 'json',
            data: {'idusuario' : $("#usuariodesactivar").val(), 'estado' : 0},
            success: function (data, textStatus, jqXHR){
                resultado = data;
                if(resultado["resultado"]==0){
                    $("#modalMensajeEstado h5").html("Desactivar usuario");
                    $("#modalMensajeEstado p").html("Se ha desactivado al usuario correctamente.");
                    $("#modalMensajeEstado").modal('show');
                }
            }
        })
    })
    
    $("#btnConfirmarCambioClave").click(function(){
        console.log("Actualizando clave de usuario");
        $.ajax({
            url: "php/controladores/UsuarioCambiarClave.php",
            method: 'PUT',
            dataType: 'json',
            data: {'password1' : $("#nuevapassword1").val(), 'password2' : $("#nuevapassword2").val(),
                'idusuario' : $("#idusuario").val()
            },
            success: function (data, textStatus, jqXHR){
                resultadofinal = data;
                if(resultadofinal["resultado"]==0){
                    $("#modalModificarClaveMensaje").modal('show');
                }else{
                    $("#modalMensajeErrores p").html(resultadofinal.resultado);
                    $("#modalMensajeErrores").modal('show');
                }
            }
        })
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
    
    $("#btnValidarNuevo").on("click", function () {
        var v = $("#formUsuarioNuevo").valid();
        if(v){
            $("#modalConfirmarNuevo").modal("show");
            //data-toggle="modal" data-target="#modalConfirmarNuevo"
        }
    });
    
    $("#btnValidarMod").on("click", function () {
        var v = $("#formUsuario").valid();
        if(v){
            $("#modalConfirmarModificar").modal("show")
            //data-toggle="modal" data-target="#modalConfirmarModificar"
        } 
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
                html = "";
                $.each(data, function(key, value){
                    var estado;
                    if (value.estado==1){
                        estado="Activo";
                        html = '<tr>';
                    }
                    if (value.estado==0){
                        estado="Desactivado";
                        html = '<tr style="color:red">';
                    }
                    if (value.estado==2){
                        estado="Bloqueado";
                        html = '<tr style="color:blue">'
                    }
                    html+= '<td>' + value.rut + '</td>'
                    + '<td>' + value.nombres + '</td>'
                    + '<td>' + value.apellidos+ '</td>'
                    + '<td>' + value.email + '</td>'
                    + '<td>' + value.telefono + '</td>'
                    + '<td>' + value.perfil.descripcion + '</td>'
                    + '<td>' + estado + '</td>'
                    + '<td><input class="btn btn-info" type="button" name="modificar" id="btnmodificar" data-toggle="modal" data-target="#modalModificar" value="Modificar" onClick="ModPer('+value.id+');">';
                    if (value.estado==1){
                        html+= '<input class="ml-2 btn btn-danger" type="button" name="desactivar" id="btndesactivar" data-toggle="modal" data-target="#modalConfirmarDesactivacion" value="Desactivar" onClick="Desactivar('+value.id+');">'
                        + '<input class="ml-2 btn btn-warning" type="button" name="bloquear" id="btnbloquear" data-toggle="modal" data-target="#modalConfirmarBloqueo" value="Bloquear" onClick="Bloquear('+value.id+');">'
                    }else if (value.estado==2){
                        html+= '<input class="ml-2 btn btn-danger" type="button" name="activar" id="btnactivar" data-toggle="modal" data-target="#modalConfirmarActivacion" value="Activar" onClick="Activar('+value.id+');">'
                        + '<input class="ml-2 btn btn-warning" type="button" name="desbloquear" id="btndesbloquear" data-toggle="modal" data-target="#modalConfirmarDesbloqueo" value="Desbloquear" onClick="Desbloquear('+value.id+');">'                        
                    }else if (value.estado==0){
                        html+= '<input class="ml-2 btn btn-danger" type="button" name="activar" id="btnactivar" data-toggle="modal" data-target="#modalConfirmarActivacion" value="Activar" onClick="Activar('+value.id+');">'
                        + '<input class="ml-2 btn btn-warning" type="button" name="bloquear" id="btnbloquear" data-toggle="modal" data-target="#modalConfirmarBloqueo" value="Bloquear" onClick="Bloquear('+value.id+');">'                        
                    }
                    html+='<input class="ml-2 btn btn-info" type="button" name="cambiarclave" id="cambiarclave" data-toggle="modal" data-target="#modalCambiarClave" value="Cambiar clave" onClick="ModClave('+value.id+');"></td></tr>';
                    $grillaResultados.append(html);
                })
            }
        })        
    }
    $("#buscarPersona").click(function(){
        BuscarUsuario();
    })
})


