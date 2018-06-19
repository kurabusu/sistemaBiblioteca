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
    
});
