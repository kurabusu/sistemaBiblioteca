$(document).ready(function(){
    $.ajaxSetup({ 
        beforeSend:function(){
            $("#loading").show();
        }, 
        complete:function () {
            $("#loading").hide();
       }
    });
});
