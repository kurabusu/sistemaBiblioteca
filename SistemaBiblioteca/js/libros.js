$(document).ready(function(){
   
   $('#cmboBuscar').change(function(){
      
       var $cmboBuscar = $('#cmboBuscar');
       var $txtBuscar = $('#txtBuscar');
       
       if($cmboBuscar.val() != ""){
           
           $txtBuscar.removeAttr('disabled');
           return;
       }else{
           $txtBuscar.attr('disabled','true');
       }
   });
});

