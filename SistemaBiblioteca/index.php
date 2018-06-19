<?php
include('php/base/header.php');

if($_SERVER["REQUEST_METHOD"]=="POST"){
    include('php/dao/PersonaDAO.class.php');
    
    $personaDAO = new PersonaDAO();
    $resultado = $personaDAO->ObtenerLogin($_POST["email"], $_POST["clave"]);
    if (count($resultado)==0){
        echo '<div class="row justify-content-md-center"><div class="col-3"><div class="alert alert-danger text-center" role="alert">Usuario o clave inválida</div></div></div>';
    }else{
        session_start();
        $_SESSION["usuario"] = $resultado;
        header("Location:bienvenido.php");
    }
}
if($_SERVER["REQUEST_METHOD"]=='GET' && isset($_GET["action"]) && $_GET["action"]=="logout"){
    session_destroy();
}
?>

<div class="row justify-content-md-center pt-5 mt-5">
   <div class="col-3 ">
       <form action="index.php" method="POST">
           <div class="form-group">
               <label>E-Mail</label>    
               <input id="" class="form-control" type="text" id="email" name="email" value="" placeholder="Email" />
           </div>
           <div class="form-group">
               <label>Clave</label>    
               <input class="form-control" type="password" id="clave" name="clave" value="" placeholder="Contrase&ntilde;a" />
           </div>
           <div class="form-group text-center">
               <input class="btn btn-danger" type="reset" name="cancelar" value="Cancelar" />
               <input class="btn btn-success" type="submit" name="login" id="login" value="Entrar" />
           </div>
       </form>
   </div>
</div>

<?php
include('php/base/footer.php');
?>