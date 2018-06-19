<?php
include('php/base/header.php');
include('php/base/menu.php');
?>
<script src="js/categoria.js"></script>

<div class="row mt-2">
    <div class="col form-inline">
        <h2 class="h2">Categoria</h2>  
        <button class="ml-5 btn btn-success text-white" data-toggle="modal" data-target="#modalNuevo">Nueva Categor&iacute;a</button>
    </div>
</div>

<div class="row mt-2">
    <div class="col-7"></div>
    <div class="col-5">
      
        <form id="formConsulta" class="form-inline">
            <div class="form-group col-12">
                <label>Buscar Por: </label>
                <input class="ml-3 form-control col-8" id="txtBuscar" type="text" name="buscar" value="" required="" placeholder="C&oacute;digo / Descripci&oacute;n" />

                <input class="ml-3 btn btn-info" id="consultar" type="button" name="consultar" value="Buscar" />
            </div>
            <div class="form-group error text-center">
                <label class="error"></label>
            </div>
        </form>
                
    </div>
    <div class="col-12 mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th> C&oacute;digo</th>
                    <th> Descripci&oacute;n</th>
                    <th> Opciones</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="8"></td>
                </tr>
            </tfoot>
            <tbody id="grilla">
                
            </tbody>
        </table>
    </div>


</div>

<!-- Modal ingresar / modificar -->
<div class="modal fade modalNuevo" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nueva Categor&iacute;a</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="formNuevaCategoria">
                <div class="form-group areaPaciente">
                    <label for="txtCodigoN">C&oacute;digo: </label>
                    <input class="form-control" id="txtCodigoN" type="text" name="txtCodigoN" value=""  />
                </div>
                <div class="form-group areaPaciente">
                    <label for="txtDescripcionN">Descripci&oacute;n: </label>
                    <input class="form-control" id="txtDescripcionN" type="text" name="txtDescripcionN" value=""  />
                </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" id="btnGuardarNuevo">Guardar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade modalEditar" id="modalModificar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modificar Categor&iacute;a</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="formModificarCategoria">
                <input class="form-control" id="txtIdM" type="hidden" name="txtIdM" value=""/>
                <div class="form-group areaPaciente">
                    <label for="txtCodigoM">C&oacute;digo: </label>
                    <input class="form-control" id="txtCodigoM" type="text" name="txtCodigoM" value="" readonly />
                </div>
                <div class="form-group areaPaciente">
                    <label for="txtDescripcionM">Descripci&oacute;n: </label>
                    <input class="form-control" id="txtDescripcionM" type="text" name="txtDescripcionM" value=""  />
                </div>
            </form>
        </div> 
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-success" id='btnValidarModCat' >Modificar</button>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalAprobarMod" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Desactivar libro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>La información de la categor&iacute;a se modificara, quiere proceder?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" data-dismiss="modal"  id="btnModificar" >continuar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal desactivar / activar -->
<div class="modal fade" id="modalDesactivar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Desactivar libro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Se va desactivar una categor&iacute;a, quiere proceder?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"  data-toggle="modal" data-target="#modalDesactivarMensaje">Desactivar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDesactivarMensaje" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Desactivar  categor&iacute;a</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>La categor&iacute;a ha sido desactivado</p>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<!-- Modal Prestamo -->
<div class="modal fade" id="modalNuevoPrestamo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Prestamo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="formLibroUsuario">
               <label>Usuario : </label>
                <div class="form-inline">
                    <input class="form-control" id="rutR" type="text" name="rutR" value=""  />
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalBuscarUsarios">Buscar</button>
                </div>
                <label>Libro: </label>
                <div class="form-group areaPaciente form-inline">
                    <input class="form-control" id="libro" type="text" name="libro" value="World of warcraft. cronicas 01"  />
                    
                </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#modalPrestamoMensaje">Guardar prestamo</button>
      </div>
    </div>
  </div>
</div>
  
<!-- modal buscar usuarios -->
<div class="modal fade modal-lg" id="modalBuscarUsarios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Buscar usuario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="formLibroUsuario">
                <label>Rut / nombre / apellido </label>
                <div class="form-group areaPaciente form-inline">
                    <input class="form-control" id="txtBuscarUsuario" type="text" name="txtBuscarUsuario" placeholder="Rut / nombre / apellido " value=""  />
                    <button type="button" class="btn btn-info">Buscar</button>
                </div>
            </form>
            <div class="form-group areaPaciente">
                <table class="table">
                    <thead>
                        <tr>
                            <th> RUT</th>
                            <th> Nombre</th>
                            <th> Apellido</th>
                            <th> Email</th>
                            <th> Opción</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td colspan="7"></td>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td><label>11111111-1</label></td>
                            <td><label>Esteban</label></td>
                            <td><label>Cigarra</label></td>
                            <td><label>e.cigarra@correo.cl</label></td>
                            <td>
                                <button type="button" class="btn btn-info"  data-dismiss="modal">Seleccionar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>    
        </div>
        <div class="modal-footer"></div>
        </div>
    </div>
</div>

<!-- prestamo mensaje -->
<div class="modal fade" id="modalPrestamoMensaje" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Desactivar libro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Se ha registrado el prestamo.</p>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<?php
include('php/base/footer.php');
?>