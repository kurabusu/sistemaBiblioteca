<?php
include('php/base/header.php');
include('php/base/menu.php');
?>
<script src="js/Persona.js" type="text/javascript" ></script>
<div class="row mt-2">
    <div class="col form-inline">
        <h2 class="h2">Usuarios</h2>
        <button class="ml-5 btn btn-success text-white" data-toggle="modal" data-target="#modalNuevo">Nuevo Usuario</button>
    </div>
</div>

<div class="row mt-4">
    
    <div class="col-8">
        
    </div>
    <div class="col-4">
      
        <form id="formConsulta" class="form-inline">
            <div class="areaUsuarios form-group">
                <label>Buscar Por: </label>
                <input class="ml-3 form-control" id="txtBuscarPersona" type="text" name="buscar" value="" required="" />

                <input class="ml-3 btn btn-info" id="buscarPersona" type="button" name="btnBuscar" value="Buscar" />
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
                    <th> Opciones</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="7"></td>
                </tr>
            </tfoot>
            <tbody id="grilla">
                <tr>
                    <td></td>
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

<!--Modales de la página -->
<div class="modal fade" id="modalModificar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="formUsuario">
              <input type="hidden" id="idm" name="idm" value="">
                    
                <div class="form-group areaPaciente">
                    <label>Rut: </label>
                    <input class="form-control" id="rutm" type="text" name="rut" value="" readonly />
                </div>
                <div class="form-group areaPaciente">
                    <label>Nombres: </label>
                    <input class="form-control" id="nombresm" type="text" name="nombres" value="" readonly />
                </div>
                <div class="form-group areaPaciente">
                    <label>Apellidos: </label>
                    <input class="form-control" id="apellidosm" type="text" name="apellidos" value=""  readonly />
                </div>
                <div class="form-group areaPaciente">
                    <label>Mail: </label>
                    <input class="form-control" id="emailm" type="text" name="email" value="" />
                </div>
                <div class="form-group areaPaciente">
                    <label>Tel&eacute;fono: </label>
                    <input class="form-control" id="telefonom" type="text" name="telefono" value=""  />
                </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalConfirmarModificar" >Modificar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal confirmar modificacion -->
<div class="modal fade" id="modalConfirmarModificar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Confirma la modificaci&oacute;n de los datos?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"  data-toggle="modal" data-target="#modalConfirmarModificar">Aceptar</button>
            </div>
        </div>
    </div>
</div>


<!-- mensaje -->
<div class="modal fade" id="modalModificarMensaje" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Se ha modificado la informaci&oacute;n del usuario correctamente.</p>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<?php
include('php/base/footer.php');
?>