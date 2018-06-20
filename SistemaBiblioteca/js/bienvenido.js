$(document).ready(function(){
    
     function mostrarMisReservas(){
        idPe = $("#btnMisDatos").attr("attr-perfil");
        idU = $("#btnMisDatos").attr("attr-id");
        $.ajax({
            url: "php/controladores/ReservaObtener.php",
            method: "GET",
            dataType: 'json',
            data:{
                'persona':idU
            },
             success: function (data, textStatus, jqXHR) {
                arr = data, //JSON.parse(data);
                lista = arr.resultado;
                $.each(arr.resultado, function(index, value){
                    h = '<tr>'
                    + '<td>'+value.libro.titulo+'</td>'
                    + '<td>'+value.fechaReserva+'</td>'
                    + '</tr>';
                    
                    $("#tabReservas .grilla").append(h);
                });
            }
        });
    }
    
    function mostrarMisPedidos(){
        idPe = $("#btnMisDatos").attr("attr-perfil");
        idU = $("#btnMisDatos").attr("attr-id");
        
         $.ajax({
            url: "php/controladores/PrestamoObtener.php", 
            method: "GET",
            dataType: "json",
            data:{ 
                'persona':idU
            },
            success: function (data, textStatus, jqXHR) {
                arr = data, //JSON.parse(data);
                lista = arr.resultado;
                $.each(arr.resultado, function(index, value){
                    h ='<tr>'
                    + '<td>'+value["libro"]["titulo"]+'</td>'
                    + '<td>'+value["fechaEntrega"]+'</td>'
                    + '<td>'
                    + '</td</tr>'; 
                    $("#tabPedidos .grilla").append(h);
                });
                
                $(".btnDevolverLibro").on("click", function () {
                    index= $(this).attr("attr-index");
                    $("#btnValidarDevolver").attr("attr-id",lista[index].id);
                    $("#modalValidacionDevolver").modal("show");
                });
            }
        });
        
    }
    
    mostrarMisReservas();
    mostrarMisPedidos();
    
})