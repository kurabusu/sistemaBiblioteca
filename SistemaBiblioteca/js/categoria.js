$(document).ready(function (){
   
    $("#btnGuardarNuevo").on("click", function (){
       var codigo = $("#txtCodigoN").val();
       var descripcion = $("#txtDescripcionN").val();
   
         $.ajax({
            "url": "php/controladores/CategoriaNuevo.php",
            "method": "PUT",
            "datatype": "JSON",
            "data": {
                "codigo": codigo,
                "descripcion": descripcion
            },
            success : function (data, textStatus, jqXHR) {
                console.log(data);
            }
        });
    });
    
    
});

