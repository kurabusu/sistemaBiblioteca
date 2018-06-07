<?php
include('php/base/header.php');
include('php/base/menu.php');
?>
<div class="row mt-2">
    <div class="col form-inline">
        <h2 class="h2">Prestamos</h2>
        <button class="ml-5 btn btn-success text-white" data-toggle="modal" data-target="#modalNuevoPrestamo">Nuevo Prestamo</button>
    </div>
</div>

<div class="row mt-2">
    
    <div class="col-8"> </div>
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
    
    <div class="col-12 mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th> Nombre</th>
                    <th> Libro</th>
                    <th> Fecha devolouci&oacute;n</th>
                    <th> Opciones</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="4"></td>
                </tr> 
            </tfoot>
            <tbody>
                <tr>
                    <td><label>Antonio Torres</label></td>
                    <td><label>World of warcraft. cronicas 01</label></td>
                    <td><label>08-06-2018</label></td>
                    <td>
                        
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
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
                    <input class="form-control" id="libro" type="text" name="libro" value=""  />
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalBuscarLibro">Buscar</button>
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
<div class="modal fade" id="modalBuscarUsarios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

<!-- modal buscar usuarios -->
<div class="modal fade" id="modalBuscarLibro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buscar libro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formLibroUsuario">
                    <label>ISBN / Titulo / Autor </label>
                    <div class="form-group areaPaciente form-inline">
                        <input class="form-control" id="rutR" type="text" name="rutR" placeholder="ISBN / Titulo / Autor " value=""  />
                        <button type="button" class="btn btn-info">Buscar</button>
                    </div>
                </form>
                <div class="form-group areaPaciente">
                    <table class="table">
                        <thead>
                            <tr>
                                <th> ISBN</th>
                                <th> Titulo</th>
                                <th> Autor</th>
                                <th> Editorial</th>
                                <th> Año</th>
                                <th> Cantidad</th>
                                <th> Opción</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td colspan="8"></td>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td><label>9788490945445</label></td>
                                <td><label>World of warcraft. cronicas 01</label></td>
                                <td><label>Varios autores</label></td>
                                <td><label>Panini</label></td>
                                <td><label>2016</label></td>
                                <td><label>5</label></td>
                                <td>
                                <button type="button" class="btn btn-info"  data-dismiss="modal">Seleccionar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
            </div>
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