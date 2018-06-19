<?php
include('php/base/header.php');
include('php/base/menu.php');
?>
<script src="js/prestamos.js"></script>
<div class="row mt-2">
    <div class="col form-inline">
        <h2 class="h2">Prestamos</h2>
        <button class="ml-5 btn btn-success text-white" data-toggle="modal" data-target="#modalNuevoPrestamo">Nuevo Prestamo</button>
    </div>
</div>

<div class="row mt-2">
    
    <div class="col-7"> </div>
    <div class="col-5">
        <form id="formConsulta" class="form-inline" onSubmit="return false">
            <div class="form-group col-12">
                <label>Buscar Por: </label>
                <input class="ml-3 form-control col-8" id="txtBuscar" type="text" name="buscar" value="" required="" placeholder="Nombre persona / Titulo libro" />

                <input class="ml-3 btn btn-info" id="consultar" type="button" name="btnBuscar" value="Buscar" />
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
            <tbody id="grilla"></tbody>
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
          <form id="formNuevoPrestamo">
                <label>Usuario : </label>
                <div class="form-inline mb-3">
                    <input class="form-control col-9" id="mnpUsuario" type="text" name="mnpUsuario" value="" readonly/>
                    <button type="button" class="btn btn-info ml-2" data-toggle="modal" data-target="#modalBuscarUsarios">Buscar</button>
                </div>
                <label>Libro: </label>
                <div class="form-inline mb-3">
                    <input class="form-control col-9" id="mnpLibro" type="text" name="mnpLibro" value="" readonly/>
                    <button type="button" class="btn btn-info ml-2" data-toggle="modal" data-target="#modalBuscarLibro">Buscar</button>
                </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" id="btnGuardarNuevoPrestamo">Guardar prestamo</button>
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
                    <input class="form-control col-9" id="txtBuscarUsuario" type="text" name="txtBuscarUsuario" placeholder="Rut / nombre / apellido " value=""  />
                    <button type="button" class="btn btn-info" id="btnBuscarUsuario">Buscar</button>
                </div>
            </form>
            <div class="form-group areaPaciente">
                <table class="table" id="tableBuscarUsuario">
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
                    <tbody class="grilla">
                        
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
                        <input class="form-control col-9" id="txtBuscarLibro" type="text" name="rutR" placeholder="ISBN / Titulo / Autor " value=""  />
                        <button type="button" class="btn btn-info" id="btnBuscarLibro">Buscar</button>
                    </div>
                </form>
                <div class="form-group areaPaciente">
                    <table class="table" id="tableBuscarLibro">
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
                        <tbody class="grilla">
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
<div class="modal fade" id="modalValidacionDevolver" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Devolución de libro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Se procedera con la devolución del libro. Quiere proceder?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="btnValidarDevolver">Devolver libro</button>
            </div>
        </div>
    </div>
</div>
<?php
include('php/base/footer.php');
?>