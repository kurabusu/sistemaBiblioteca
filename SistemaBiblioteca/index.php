<?php
include('php/base/header.php');
?>

<div class="row justify-content-md-center pt-5 mt-5">
   <div class="col-3 ">
       <form action="bienvenido.php" method="POST">
           <div class="form-group">
               <label>E-Mail</label>    
               <input id="" class="form-control" type="email" name="email" value="" />
           </div>
           <div class="form-group">
               <label>Clave</label>    
               <input class="form-control" type="password" name="clave" value="" />
           </div>
           <div class="form-group text-center">
               <input class="btn btn-danger" type="reset" name="cancelar" value="Cancelar" />
               <input class="btn btn-success" type="submit" name="login" value="Entrar" />
           </div>
       </form>
   </div>
</div>

<?php
include('php/base/footer.php');
?>