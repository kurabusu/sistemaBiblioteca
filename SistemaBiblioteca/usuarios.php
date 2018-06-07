<?php
include('php/base/header.php');
include('php/base/menu.php');
?>
<div class="row mt-2">
    <div class="col">
        <h2 class="h2">Usuarios</h2>
    </div>
</div>

<div class="row mt-4">
    
    <div class="col-8">
        
    </div>
    <div class="col-4">
      
        <form id="formConsulta" class="form-inline">
            <div class="areaPaciente form-group">
                <label>Buscar Por: </label>
                <input class="ml-3 form-control" id="txtBuscar" type="text" name="buscar" value="" required="" />

                <input class="ml-3 btn btn-info" id="consultar" type="button" name="btnBuscar" value="Buscar" />
            </div>
            <div class="form-group error text-center">
                <label class="error"></label>
            </div>
        </form>
                
    </div>
    
    <div class="col-12  mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th> RUT</th>
                    <th> Nombre</th>
                    <th> Apellido</th>
                    <th> Email</th>
                    <th> Tel&eacute;fono</th>
                    <th> Perfil</th>
                    <th> Estado</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="7"></td>
                </tr>
            </tfoot>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
    
</div>

       

<?php
include('php/base/footer.php');
?>