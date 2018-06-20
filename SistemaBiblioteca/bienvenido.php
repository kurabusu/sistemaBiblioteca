<?php
include('php/base/header.php');
include('php/base/menu.php');
?>
<div class="row mt-2">
    <div class="col">
        <h2 class="h2">Bienvenido</h2>
    </div>
</div>

<div class="row mt-2">
    <div class="col">
        <p>Sistema de biblioteca</p>
        <?php if($usuario["perfil_id"] == 3 ){ ?>
            <h3 class="h3">Reservas</h3>
            <table class="tabReservas">
                <thead>
                    <tr>
                        <th> Titulo libro</th>
                        <th> Fecha</th>
                    </tr>
                </thead>
                <tfoot> 
                    <tr>
                        <td colspan="7"></td>
                    </tr>
                </tfoot>
                <tbody id="grilla">
                </tbody>
            </table>
        <?php }?>
        
        <?php if($usuario["perfil_id"] == 3 || $usuario["perfil_id"] ==4){ ?>
            <h3 class="h3">Pedidos</h3>
            <table class="tabPedidos">
                 <thead>
                    <tr>
                        <th> Titulo libro</th>
                        <th> Fecha</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td colspan="7"></td>
                    </tr>
                </tfoot>
                <tbody id="grilla">
                </tbody>
            </table>
        <?php }?>
        
    </div>
</div>

       

<?php
include('php/base/footer.php');
?>