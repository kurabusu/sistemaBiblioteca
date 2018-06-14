<?php
include('php/base/header.php');
include('php/base/menu.php');
?>
<script src="js/reserva.js"></script>
<div class="row mt-2">
    <div class="col form-inline">
        <h2 class="h2">Reservas</h2>
        <button class="ml-5 btn btn-success text-white" data-toggle="modal" data-target="#modalNuevo">Nueva Reserva</button>
    </div>
</div>

<div class="row mt-2">
    
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
    
    <div class="col-12 mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th> Solicitante</th>
                    <th> Libro</th>
                    <th> Fecha</th>
                    <th> Opciones</th>
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
    </div>

</div>

     <!-- Modal -->
<div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nueva Reserva</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="formLibroUsuario">
                <div class="form-group areaPaciente">
                    <label>Rut usuario: </label>
                    <input class="form-control" id="rutS" type="text" name="rutS" value=""  />
                </div>
                <div class="form-group areaPaciente">
                    <label>Libro: </label>
                    <input class="form-control" id="anno" type="text" name="anno" value=""  />
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
  
<!-- Modal cancelar -->
<div class="modal fade" id="modalCancelar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Desactivar libro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Se va a cancelar una reserva, quiere proceder?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"  data-toggle="modal" data-target="#modalCancelarMensaje">Cancelar Reserva</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCancelarMensaje" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Desactivar libro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>La reserva ha sido cancelada.</p>
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
                    <input class="form-control" id="rutR" type="text" name="rutR" value="Jose Tolosa "  />
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