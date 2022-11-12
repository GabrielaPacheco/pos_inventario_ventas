  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              Administrar Productos
          </h1>
          <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
              <li class="active">Administrar Productos</li>
          </ol>
      </section>
      <section class="content">
          <div class="box">
              <div class="box-header with-border">
                  <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">
                      Agregar Producto
                  </button>
              </div>
              <div class="box-body">
                  <table class="table table-bordered table-striped dt-responsive tablaProductos" width="100%">
                      <thead>
                          <tr>
                              <th style="width: 10px;">#</th>
                              <th>Imagen</th>
                              <th>Código</th>
                              <th>Descripción</th>
                              <th>Categoría</th>
                              <th>Stock</th>
                              <th>Precio de compra</th>
                              <th>Precio de venta</th>
                              <th>Agregado</th>
                              <th>Acciones</th>
                          </tr>
                      </thead>
                  </table>
              </div>
          </div>
      </section>
  </div>

  <!-- MODAL AGREGAR PRODUCTO -->
  <div id="modalAgregarProducto" class="modal fade" role="dialog">
      <div class="modal-dialog">
          <div class="modal-content">
              <form role="form" method="post" enctype="multipart/form-data">
                  <!-- HEADER DE MODAL -->
                  <div class="modal-header" style="background: #3c8dbc; color: white;">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Agregar Producto</h4>
                  </div>
                  <!-- BODY DEL MODAL -->
                  <div class="modal-body">
                      <div class="box-body">
                          <!-- SELECT DE INGRESO DE CATEGORÍA-->
                          <div class="form-group">
                              <div class="input-group">
                                  <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                  <select class="form-control input-lg" id="nuevaCategoria" name="nuevaCategoria" required>
                                      <option value="">Seleccionar Categoría</option>
                                      <?php
                                        $item = null;
                                        $valor = null;

                                        $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
                                        //RECORRIENDO LOS VALORES DE LA TABLA CATEGORIAS POR MEDIO DE FOREACH
                                        //Y MOSTRANDO LOS DATOS EN EL SELECT PARA SELECCIONAR LA CATEGORIA
                                        // QUE PERTENECE EL PRODUCTO
                                        foreach ($categorias as $key => $value) {
                                            echo ' <option value="' . $value["id"] . '">' . $value["categoria"] . '</option>';
                                        }
                                        ?>
                                  </select>
                              </div>
                          </div>
                          <!-- INPUT DE CÓDIGO -->
                          <div class="form-group">
                              <div class="input-group">
                                  <span class="input-group-addon"><i class="fa fa-code"></i></span>
                                  <input type="text" class="form-control input-lg" id="nuevoCodigo" name="nuevoCodigo" placeholder="Ingresar código" readonly required>
                              </div>
                          </div>
                          <!-- INPUT DE INGRESO DE DESCRIPCION-->
                          <div class="form-group">
                              <div class="input-group">
                                  <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                                  <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar descripción" required>
                              </div>
                          </div>
                          <!-- INPUT DE INGRESO DE STOCK-->
                          <div class="form-group">
                              <div class="input-group">
                                  <span class="input-group-addon"><i class="fa fa-check"></i></span>
                                  <input type="number" class="form-control input-lg" name="nuevoStock" min="0" placeholder="Stock disponible" required>
                              </div>
                          </div>
                          <!-- INPUT DE INGRESO DE PRECIO DE COMPRA-->
                          <div class="form-group row">
                              <div class="col-xs-12 col-sm-6">
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                                      <input type="number" class="form-control input-lg" id="nuevoPrecioCompra" name="nuevoPrecioCompra" min="0" step="any" placeholder="Precio de compra" required>
                                  </div>
                              </div>
                              <!-- INPUT DE INGRESO DE PRECIO DE VENTA-->
                              <div class="col-xs-12 col-sm-6">
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                                      <input type="number" class="form-control input-lg" id="nuevoPrecioVenta" name="nuevoPrecioVenta" min="0" step="any" placeholder="Precio de venta" required>
                                  </div>
                                  <br>
                                  <!-- INPUT DE CHECKBOX PARA SABER SI CUANTO PORCENTAJE DE GANANCIA APLICA A LA VENTA-->
                                  <div class="col-xs-6">
                                      <div class="form-group">
                                          <label>
                                              <input type="checkbox" class="minimal porcentaje" checked>
                                              Utilizar porcentaje </label>
                                      </div>
                                  </div>
                                  <!-- INPUT DE PARA PORCENTAJE-->
                                  <div class="col-xs-6" style="padding:0">
                                      <div class="input-group">
                                          <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>
                                          <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                      </div>
                                  </div>
                              </div>

                          </div>
                          <!-- INPUT DE IMAGEN-->
                          <div class="form-group">
                              <div class="panel text">
                                  SUBIR IMAGEN
                              </div>
                              <input type="file" name="nuevaImagen" class="nuevaImagen">
                              <p class="help-block">Peso máximo de la foto 2 MB</p>
                              <img src="views/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
                          </div>
                      </div>
                  </div>
                  <!-- FOOTER DEL MODAL -->
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                      <button type="submit" class="btn btn-primary">Guardar Producto</button>
                  </div>
              </form>
              <?php
                $crearProducto = new ControladorProductos();
                $crearProducto->ctrCrearProducto();
                ?>
          </div>
      </div>
  </div>

  <!-- MODAL EDITAR PRODUCTO -->
  <div id="modalEditarProducto" class="modal fade" role="dialog">
      <div class="modal-dialog">
          <div class="modal-content">
              <form role="form" method="post" enctype="multipart/form-data">
                  <!-- HEADER DE MODAL -->
                  <div class="modal-header" style="background: #3c8dbc; color: white;">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Editar Producto</h4>
                  </div>
                  <!-- BODY DEL MODAL -->
                  <div class="modal-body">
                      <div class="box-body">
                          <!-- SELECT DE INGRESO DE CATEGORÍA-->
                          <div class="form-group">
                              <div class="input-group">
                                  <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                  <select class="form-control input-lg" name="editarCategoria" readonly required>
                                      <option id="editarCategoria"></option>
                                  </select>
                              </div>
                          </div>
                          <!-- INPUT DE CÓDIGO -->
                          <div class="form-group">
                              <div class="input-group">
                                  <span class="input-group-addon"><i class="fa fa-code"></i></span>
                                  <input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigo" readonly required>
                              </div>
                          </div>
                          <!-- INPUT DE INGRESO DE DESCRIPCION-->
                          <div class="form-group">
                              <div class="input-group">
                                  <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                                  <input type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion" id="editarDescripcion" required>
                              </div>
                          </div>
                          <!-- INPUT DE INGRESO DE STOCK-->
                          <div class="form-group">
                              <div class="input-group">
                                  <span class="input-group-addon"><i class="fa fa-check"></i></span>
                                  <input type="number" class="form-control input-lg" id="editarStock" name="editarStock" min="0" required>
                              </div>
                          </div>
                          <!-- INPUT DE INGRESO DE PRECIO DE COMPRA-->
                          <div class="form-group row">
                              <div class="col-xs-12 col-sm-6">
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                                      <input type="number" class="form-control input-lg" id="editarPrecioCompra" name="editarPrecioCompra" min="0" step="any" required>
                                  </div>
                              </div>
                              <!-- INPUT DE INGRESO DE PRECIO DE VENTA-->
                              <div class="col-xs-12 col-sm-6">
                                  <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                                      <input type="number" class="form-control input-lg" id="editarPrecioVenta" name="editarPrecioVenta" min="0" step="any" readonly required>
                                  </div>
                                  <br>
                                  <!-- INPUT DE CHECKBOX PARA SABER SI CUANTO PORCENTAJE DE GANANCIA APLICA A LA VENTA-->
                                  <div class="col-xs-6">
                                      <div class="form-group">
                                          <label>
                                              <input type="checkbox" class="minimal porcentaje" checked>
                                              Utilizar porcentaje </label>
                                      </div>
                                  </div>
                                  <!-- INPUT DE PARA PORCENTAJE-->
                                  <div class="col-xs-6" style="padding:0">
                                      <div class="input-group">
                                          <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>
                                          <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                      </div>
                                  </div>
                              </div>

                          </div>
                          <!-- INPUT DE IMAGEN-->
                          <div class="form-group">
                              <div class="panel text">
                                  SUBIR IMAGEN
                              </div>
                              <input type="file" name="editarImagen" class="nuevaImagen">
                              <p class="help-block">Peso máximo de la foto 2 MB</p>
                              <img src="views/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
                              <input type="hidden" name="imagenActual" id="imagenActual">
                          </div>
                      </div>
                  </div>
                  <!-- FOOTER DEL MODAL -->
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                      <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                  </div>
              </form>
              <?php
                $editarProducto = new ControladorProductos();
                $editarProducto->ctrEditarProducto();
                ?>
          </div>
      </div>
  </div>

  <?php
    $eliminarProducto = new ControladorProductos();
    $eliminarProducto->ctrEliminarProducto();
    ?>