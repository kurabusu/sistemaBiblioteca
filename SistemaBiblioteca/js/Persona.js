$(document).ready(function(){
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
                    + '<td>' + estado + '</td>';
                    html+="</tr>";
                    $grillaResultados.append(html);
                })
            }
        })
    })
})


