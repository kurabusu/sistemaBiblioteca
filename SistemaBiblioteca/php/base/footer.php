                
            </div>
        </div>
        <footer class="fixed-bottom pt-2 pb-2 text-center bg-dark text-white">
            <label>Los Perpedinculares</label>
        </footer>
        <div class="modal fade" id="modalMensajes" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Mensaje</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="mensaje"></p>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        
<!--Modales de la página -->
<div class="modal fade" id="modalModificarDatos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Datos (para cambio de clave ac&eacute;rquese al administrador)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="formMisDatos">
              <div class="row">
                  <div class="col-6">
                      <input type="hidden" id="idusuariologin" name="id" value="<?=$usuario["id"];?>">
                      <input type="hidden" id="perfilusuariologin" name="perfil" value="<?=$usuario["perfil_id"];?>">
                      <div class="form-group">
                          <label>Rut: </label>
                          <input class="form-control" id="rutusuario" type="text" name="rut" value="<?=$usuario["rut"];?>" readonly />
                      </div>
                      <div class="form-group">
                          <label>Nombres: </label>
                          <input class="form-control" id="nombresusuario" type="text" name="nombres" value="<?=$usuario["nombres"];?>" />
                      </div>
                      <div class="form-group">
                          <label>Apellidos: </label>
                          <input class="form-control" id="apellidosusuario" type="text" name="apellidos" value="<?=$usuario["apellidos"];?>" />
                      </div>
                      <div class="form-group">
                          <label>Mail: </label>
                          <input class="form-control" id="emailusuario" type="text" name="email" value="<?=$usuario["email"];?>" />
                      </div>                      
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                        <label>Tel&eacute;fono: </label>
                        <input class="form-control" id="telefonousuario" type="text" name="telefono" value="<?=$usuario["telefono"];?>"  />
                    </div>                      
                  </div>
              </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalConfirmarMisDatos" id="btnActualizarDatos">Actualizar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal confirmar cambio de datos -->
<div class="modal fade" id="modalConfirmarMisDatos" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar datos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Est&aacute; seguro de actualizar sus datos?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-success" data-dismiss="modal" id="btnConfirmarCambioDatos">Si</button>
            </div>
        </div>
    </div>
</div>

<!-- mensaje modificar -->
<div class="modal fade" id="modalModificarDatosMensaje" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar datos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Su informaci&oacute;n personal se ha actualizado correctamente.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="button" data-dismiss="modal" id="btnaceptarmisdatos">Aceptar</button>
            </div>
        </div>
    </div>
</div>
    </body>
</html>