<?php
    $usuario = null;
    
    if(isset($_SESSION["usuario"])){
        $usuario = $_SESSION["usuario"];
    }else{
        header("Location: index.php");
    }
?>
<div class="row">
    <div class="col pl-0">
        <nav class="navbar float-left pl-0">
            <ul class="nav">
                <li class="nav-item"> <a class="nav-link" href="bienvenido.php">Biblioteca</a></li>
                <li class="nav-item"> <a class="nav-link" href="libros.php">Libros</a></li>
                <li class="nav-item"> <a class="nav-link" href="categoria.php">Categoria</a></li> 
                <li class="nav-item"> <a class="nav-link" href="reserva.php">Reserva</a> </li>
                <li class="nav-item"> <a class="nav-link" href="prestamos.php">Prestamos</a> </li>
                <?php if ($usuario["perfil_id"]==1){ ?>
                <li class="nav-item"> <a class="nav-link" href="usuarios.php">Usuarios</a> </li>
                <?php } ?>
            </ul>

        </nav>
        <div class="navbar float-right">
             <ul  class="nav ">
                 <li class="nav-item"><label class="nav-link"> Usuario: <?= $usuario["nombres"]." ".$usuario["apellidos"];?> </label></li>
                 <li class="nav-item"><a href="index.php?action=logout" class="nav-link text-danger">Desconectar</a></li>
            </ul>
        </div>
    </div>
</div>

