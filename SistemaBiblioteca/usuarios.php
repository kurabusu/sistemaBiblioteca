<?php
include('php/base/header.php');
include('php/base/menu.php');
?>
<script src="js/Persona.js" type="text/javascript" ></script>
<div class="row mt-2">
    <div class="col form-inline">
        <h2 class="h2">Usuarios</h2>
        <button class="ml-5 btn btn-success text-white" data-toggle="modal" data-target="#modalAgregarNuevo">Nuevo Usuario</button>
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
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="formUsuario">
              <div class="row">
                  <div class="col-6">
                    <input type="hidden" id="idm" name="idm" value="">                    
                      <div class="form-group">
                          <label>Rut: </label>
                          <input class="form-control" id="rutm" type="text" name="rut" value="" readonly />
                      </div>
                      <div class="form-group">
                          <label>Nombres: </label>
                          <input class="form-control" id="nombresm" type="text" name="nombres" value="" />
                      </div>
                      <div class="form-group">
                          <label>Apellidos: </label>
                          <input class="form-control" id="apellidosm" type="text" name="apellidos" value="" />
                      </div>
                      <div class="form-group">
                          <label>Mail: </label>
                          <input class="form-control" id="emailm" type="text" name="email" value="" />
                      </div>                      
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                        <label>Tel&eacute;fono: </label>
                        <input class="form-control" id="telefonom" type="text" name="telefono" value=""  />
                    </div>
                    <div class="form-group">
                        <label>Perfil: </label>
                        <select name="perfilm" id="tipoperfilm" class="form-control">

                        </select>
                    </div>
                      
                  </div>
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

<!-- Modal nuevo usuario -->
<div class="modal fade" id="modalAgregarNuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="formUsuarioNuevo">  
              <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                        <label>Rut: </label>
                        <input class="form-control" id="rut" type="text" name="rut" value="" />
                    </div>
                    <div class="form-group">
                        <label>Nombres: </label>
                        <input class="form-control" id="nombres" type="text" name="nombres" value="" />
                    </div>
                    <div class="form-group">
                        <label>Apellidos: </label>
                        <input class="form-control" id="apellidos" type="text" name="apellidos" value=""  />
                    </div>
                    <div class="form-group">
                        <label>Mail: </label>
                        <input class="form-control" id="email" type="text" name="email" value="" />
                    </div>                      
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                        <label>Tel&eacute;fono: </label>
                        <input class="form-control" id="telefono" type="text" name="telefono" value=""  />
                    </div>
                    <div class="form-group">
                        <label>Contrase&ntilde;a: </label>
                        <input class="form-control" id="clave1" type="password" name="clave1" />
                    </div>
                    <div class="form-group">
                        <label>Repetir contrase&ntilde;a: </label>
                        <input class="form-control" id="clave2" type="password" name="clave2" />
                    </div>
                    <div class="form-group">
                        <label>Perfil: </label>
                        <select name="perfil" id="tipoperfil" class="form-control">
                            <option value="" disabled>-- Seleccione tipo de perfil --</option>
                        </select>
                    </div>                      
                  </div>
              </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnCancelarNuevo">Cancelar</button>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalConfirmarNuevo" >Agregar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal confirmar nuevo -->
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
                <p>¿Está seguro de actualizar la informaci&oacute;n del usuario?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-success" data-dismiss="modal" id="btnConfirmarModificar">Si</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal confirmar modificacion -->
<div class="modal fade" id="modalConfirmarNuevo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Guardar datos de nuevo usuario?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-success" data-dismiss="modal" id="btnConfirmarNuevo">Si</button>
            </div>
        </div>
    </div>
</div>

<!-- mensaje modificar -->
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
                <button class="btn btn-success" type="button" data-dismiss="modal" id="btnaceptarmodificar">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<!-- mensaje agregar -->
<div class="modal fade" id="modalAgregarMensaje" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Se ha agregado al nuevo usuario correctamente.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="button" data-dismiss="modal" id="btnaceptarnuevo">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<!-- mensaje errores -->
<div class="modal fade" id="modalMensajeErrores" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Errores detectados</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Se ha agregado al nuevo usuario correctamente.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="button" data-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<?php
include('php/base/footer.php');
?>