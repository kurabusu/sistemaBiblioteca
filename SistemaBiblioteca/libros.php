<?php
include('php/base/header.php');
include('php/base/menu.php');
?>
<script src="js/libros.js" type="text/javascript"></script>
<div class="row mt-2">
    <div class="col form-inline">
        <h2 class="h2">Libros</h2>  
        <button class="ml-5 btn btn-success text-white" data-toggle="modal" data-target="#modalNuevo">Nuevo libro</button>
    </div>
</div>

<div class="row mt-4">
    <div class="col-8"></div>
    <div class="col-4">
      
        <form id="formConsulta" class="form-inline" autocomplete="off">
            <div class="form-group">
                <label>Buscar Por: </label>
                <select class="ml-3 form-control" id="cmboBuscar" name="cmboBuscar">
                    <option value="" >Buscar</option>
                    <option value="1" >ISBN</option>
                    <option value="2" >Título</option>
                    <option value="3" >Autor</option>
                    <option value="4" >Editorial</option>   
                </select>
                <input class="ml-3 form-control" id="txtBuscar" type="text" name="buscar" value="" required="" disabled=""/>

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
                    <th> ISBN</th>
                    <th> Titulo</th>
                    <th> Autor</th>
                    <th> Editorial</th>
                    <th> Año</th>
                    <th> Cantidad</th>
                    <th> Categoria</th>
                    <th> Opciones</th>
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
                    <td><label>Cómic</label></td>
                    <td>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalNuevoPrestamo">Prestar</button>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalModificar">Modificar</button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDesactivar">Desactivar</button>
                    </td>
                </tr>
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
            </tbody>
        </table>
    </div>


</div>

<!-- Modal ingresar / modificar -->
<div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo libro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="formLibroUsuario">
                <div class="form-group areaPaciente">
                    <label>ISBN: </label>
                    <input class="form-control" id="isbn" type="text" name="isbn" value=""  />
                </div>
                <div class="form-group areaPaciente">
                    <label>Titulo: </label>
                    <input class="form-control" id="titulo" type="text" name="titulo" value=""  />
                </div>
                <div class="form-group areaPaciente">
                    <label>Autor: </label>
                    <input class="form-control" id="autor" type="text" name="autor" value=""  />
                </div>
                <div class="form-group areaPaciente">
                    <label>Editorial: </label>
                    <input class="form-control" id="editorial" type="text" name="editorial" value=""  />
                </div>
                <div class="form-group areaPaciente">
                    <label>A&ntilde;o: </label>
                    <input class="form-control" id="anno" type="text" name="anno" value=""  />
                </div>
                <div class="form-group areaPaciente">
                    <label>Categor&iacute;a: </label>
                    <input class="form-control" id="categoria" type="text" name="categoria" value=""  />
                </div>
                <div class="form-group areaPaciente">
                    <label>Cantidad: </label>
                    <input class="form-control" id="cantidad" type="number" name="cantidad" value=""  />
                </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success">Guardar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalModificar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar libro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="formLibroUsuario">
                <div class="form-group areaPaciente">
                    <label>ISBN: </label>
                    <input class="form-control" id="isbn" type="text" name="isbn" value=""  />
                </div>
                <div class="form-group areaPaciente">
                    <label>Titulo: </label>
                    <input class="form-control" id="titulo" type="text" name="titulo" value=""  />
                </div>
                <div class="form-group areaPaciente">
                    <label>Autor: </label>
                    <input class="form-control" id="autor" type="text" name="autor" value=""  />
                </div>
                <div class="form-group areaPaciente">
                    <label>Editorial: </label>
                    <input class="form-control" id="editorial" type="text" name="editorial" value=""  />
                </div>
                <div class="form-group areaPaciente">
                    <label>A&ntilde;o: </label>
                    <input class="form-control" id="anno" type="text" name="anno" value=""  />
                </div>
                <div class="form-group areaPaciente">
                    <label>Categor&iacute;a: </label>
                    <input class="form-control" id="categoria" type="text" name="categoria" value=""  />
                </div>
                <div class="form-group areaPaciente">
                    <label>Cantidad: </label>
                    <input class="form-control" id="cantidad" type="number" name="cantidad" value=""  />
                </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success">Modificar</button>
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
                <p>Se va desactivar un libro, quiere proceder?</p>
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
                <h5 class="modal-title" id="exampleModalLabel">Desactivar libro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>El libro ha sido desactivado</p>
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