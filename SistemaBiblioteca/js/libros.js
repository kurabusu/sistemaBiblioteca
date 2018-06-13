$(document).ready(function(){
   
   $('#cmboBuscar').change(function(){
      
       var $cmboBuscar = $('#cmboBuscar');
       var $txtBuscar = $('#txtBuscar');
       var $btnBuscar = $('#consultar');
       
       if($cmboBuscar.val() !== ""){
           
           $txtBuscar.removeAttr('disabled');
           return;
         
       }else{
           $txtBuscar.attr('disabled','true');
           $btnBuscar.attr('disabled', 'true');
       }
   });
   
   $('#txtBuscar').on('keyup',function(){
       var $txtBuscar = $('#txtBuscar');
       var $btnBuscar = $('#consultar');
       
       if($txtBuscar.val() !==""){
            $btnBuscar.removeAttr('disabled');
       }else{
           $btnBuscar.attr('disabled', 'true');
       }
   });
   
   $('#consultar').click(function (){
       var $metodoBusqueda = $('#cmboBuscar').val();
       var $palabraBusqueda = $('#txtBuscar').val();
       
       switch($metodoBusqueda){
           case "1":
               
               break;
           case "2":
               break;
           case "3":
               break;
           case "4":
               break;
           default:
               break;
       }
   });
   
});

