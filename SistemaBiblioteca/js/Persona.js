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
              $('#rutm').val(value.rut);
              $('#nombresm').val(value.nombres);
              $('#apellidosm').val(value.apellidos);
              $('#telefonom').val(value.telefono);
              $('#emailm').val(value.email);
            })
        }
    })
}

$(document).ready(function(){
    $("#btnConfirmarNuevo").click(function(){
        console.log("Guardando nueva persona");
        
       /* $("#rut").val();
        $("#nombres").val();
        $("#apellidos").val();
        $("#email").val();
            'telefono' : $("#telefono").val(),'perfil' : $("#tipoperfil").val(),
            'password' : $("#clave1").val()
        */
        $.ajax({
            url: "php/controladores/PersonaNuevo.php",
            method: 'POST',
            dataType: 'json',
            data: {'rut' : $("#rut").val(),'nombres' : $("#nombres").val(),
            'apellidos' : $("#apellidos").val(), 'email' : $("#email").val(),
            'telefono' : $("#telefono").val(),'perfil' : $("#tipoperfil").val(),
            'password' : $("#clave1").val()},
            success: function (data, textStatus, jqXHR) {
                console.log(data);
                $("#modalAgregarMensaje").modal('show');
            }
        })
    })
    $("#buscarPersona").click(function(){
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
    })
})


