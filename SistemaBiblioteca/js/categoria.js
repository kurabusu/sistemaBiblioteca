$(document).ready(function (){
    var lista = [];
    
    $("#consultar").on("click", function(){
        console.log("#consultar");
        listar();
    });
    
    $("#btnGuardarNuevo").on("click", function (){
       var codigo = $("#txtCodigoN").val();
       var descripcion = $("#txtDescripcionN").val();
   
         $.ajax({
            "url": "php/controladores/CategoriaNuevo.php",
            "method": "POST",
            "datatype": "JSON",
            "data": {
                "codigo": codigo,
                "descripcion": descripcion
            },
            success : function (data, textStatus, jqXHR) {
                arr = JSON.parse(data);
                if(arr.resultado > 0){
                    $("#modalNuevo").modal("hide");
                    $("#txtCodigoN").val("");
                    $("#txtDescripcionN").val("");
                }else{
                    console.log("maal");
                }
            }
        });
    });
    
    $("#btnModificar").on("click", function (){
       var id = $("#txtIdM").val();
       var codigo = $("#txtCodigoM").val();
       var descripcion = $("#txtDescripcionM").val();
   
         $.ajax({
            "url": "php/controladores/CategoriaModificar.php",
            "method": "PUT",
            "datatype": "JSON",
            "data": {
                "id": id,
                "codigo": codigo,
                "descripcion": descripcion
            },
            success : function (data, textStatus, jqXHR) {
                arr = JSON.parse(data);
                console.log(arr)
                if(arr.resultado == 1){
                    console.log("bien");
                }else{
                    console.log("mal");
                }
                
            }
        });
    });
   
    // funciones 
    function listar(){
        console.log("----- listar ---------");
        $("#grilla").html("");
        busq = $("#txtBuscar").val(); 
        $.ajax({
            "url" : "php/controladores/CategoriaObtener.php",
            "method" : "GET",
            "datatype" : "JSON",
            "data" : {
                "codigo" : busq,
                "descripcion": busq
            },
            success: function (data, textStatus, jqXHR) {
                arr = JSON.parse(data);
                lista = arr.resultado;
                $.each(arr.resultado, function(index, value){
                    $("#grilla").append('<tr>'
                        + '<td>'+value["codigo"]+'</td>'
                        + '<td>'+value["descripcion"]+'</td>'
                        + '<td>'
                        + '<button type="button" class="btn btn-warning modificar" data-toggle="modal" data-target="#modalModificar" attr-index="'+index+'">Modificar</button>'
                        + '</td>'
                        + '</tr>')
                });
                
                $(".modificar").on('click',function(){
                    var i = $(this).attr("attr-index");
                    console.log(lista[i])
                    $("#txtIdM").val(lista[i]["id"]);
                    $("#txtCodigoM").val(lista[i]["codigo"]);
                    $("#txtDescripcionM").val(lista[i]["descripcion"]);
                })
            }
        })
        
    }
});

