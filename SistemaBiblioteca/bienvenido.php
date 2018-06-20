<?php
include('php/base/header.php');
include('php/base/menu.php');
?>
<script src="js/bienvenido.js"></script>
<div class="row mt-2">
    <div class="col">  
        <h2 class="h2">Bienvenido</h2>
    </div>
</div>

<div class="row mt-2">
    <div class="col">
        <p>Sistema de biblioteca</p>
        <?php if($usuario["perfil_id"] == 3 ){ ?>
            <div class="row">
                <div class="col">
                    <h3 class="h3">Mis reservas actuales</h3>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table id="tabReservas" class="table">
                        <thead>
                            <tr>
                                <th> Titulo libro</th>
                                <th> Reservado hasta</th>
                            </tr>
                        </thead>
                        <tfoot> 
                            <tr>
                                <td colspan="7"></td>
                            </tr>
                        </tfoot>
                        <tbody class="grilla">
                        </tbody>
                    </table>
                </div>
            </div>
        <?php }?>
        
        <?php if($usuario["perfil_id"] == 3 || $usuario["perfil_id"] ==4){ ?>
            <div class="row">
                <div class="col">
                    <h3 class="h3">Mis pedidos actuales</h3>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table id="tabPedidos" class="table">
                         <thead>
                            <tr>
                                <th> Titulo libro</th>
                                <th> Fecha Entrega</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td colspan="7"></td>
                            </tr>
                        </tfoot>
                        <tbody class="grilla">
                        </tbody>
                    </table>
                </div>
            </div>
        
                
        <?php }?>
        
    </div>
</div>

       

<?php
include('php/base/footer.php');
?>