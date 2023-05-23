<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Administrar Clientes
        </h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Administrar Clientes</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCliente">
                    Agregar Cliente
                </button>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                    <thead>
                        <tr>
                            <th style="width: 10px;">#</th>
                            <th>Nombre</th>
                            <th>Documento ID</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Total compras</th>
                            <th>Última compra</th>
                            <th>Ingreso al sistema</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $item = null;
                        $valor = null;

                        $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
                        //RECORRIENDO LOS VALORES DE LA TABLA CLIENTES POR MEDIO DE FOREACH
                        //Y MOSTRANDO LOS DATOS EN EL DATABLE
                        foreach ($clientes as $key => $value) {
                            echo ' <tr>
                                <td>' . ($key + 1) . '</td>
                                <td>' . $value["nombre"] . '</td>
                                <td>' . $value["documento"] . '</td>
                                <td>' . $value["email"] . '</td>
                                <td>' . $value["telefono"] . '</td>
                                <td>' . $value["direccion"] . '</td>
                                <td>' . $value["fecha_nacimiento"] . '</td>
                                <td>' . $value["compras"] . '</td>
                                <td>0000-00-00 00:00:00	</td>
                                <td>' . $value["fecha"] . '</td>
                                <td>
                              <div class="btn-group">
                                  <button class="btn btn-warning btnEditarCliente" data-toggle="modal" data-target="#modalEditarCliente" idCliente="' . $value["id"] . '"><i class="fa fa-pencil"></i></button>
                                  <button class="btn btn-danger btnEliminarCliente" idCliente="' . $value["id"] . '"><i class="fa fa-times"></i></button>
                              </div>
                          </td>
                                ';
                        }
                        ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<!-- MODAL AGREGAR CLIENTE -->
<div id="modalAgregarCliente" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post">
                <!-- HEADER DE MODAL -->
                <div class="modal-header" style="background: #3c8dbc; color: white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agregar Cliente</h4>
                </div>
                <!-- BODY DEL MODAL -->
                <div class="modal-body">
                    <div class="box-body">
                        <!-- INPUT DE NOMBRE DE CLIENTE -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control input-lg" name="nuevoCliente"
                                    placeholder="Ingresar nombre" required>
                            </div>
                        </div>
                        <!-- INPUT DE DOCUMENTO DE IDENTIDAD -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="number" min="0" class="form-control input-lg" name="nuevoDocumento"
                                    placeholder="Ingresar documento" required>
                            </div>
                        </div>
                        <!-- INPUT DE EMAIL DE CLIENTE -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" class="form-control input-lg" name="nuevoEmail"
                                    placeholder="Ingresar email" required>
                            </div>
                        </div>
                        <!-- INPUT DE TELÉFONO DE CLIENTE -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control input-lg" name="nuevoTelefono"
                                    placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 9999-9999'" data-mask
                                    required>
                            </div>
                        </div>
                        <!-- INPUT DE DIRECCIÓN DE CLIENTE -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input type="text" class="form-control input-lg" name="nuevaDireccion"
                                    placeholder="Ingresar dirección" required>
                            </div>
                        </div>
                        <!-- INPUT DE FECHA DE NACIMIENTO DE CLIENTE -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control input-lg" name="nuevoFechaNacimiento"
                                    placeholder="Ingresar fecha nacimiento" data-inputmask="'alias':'yyyy/mm/dd'"
                                    data-mask required>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FOOTER DEL MODAL -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar Cliente</button>
                </div>
            </form>
            <?php
            $crearCliente = new ControladorClientes();
            $crearCliente->ctrCrearCliente();
            ?>
        </div>
    </div>
</div>

<!-- MODAL EDITAR CLIENTE -->
<div id="modalEditarCliente" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post">
                <!-- HEADER DE MODAL -->
                <div class="modal-header" style="background: #3c8dbc; color: white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar Cliente</h4>
                </div>
                <!-- BODY DEL MODAL -->
                <div class="modal-body">
                    <div class="box-body">
                        <!-- INPUT DE NOMBRE DE CLIENTE -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control input-lg" name="editarCliente" id="editarCliente"
                                    required>
                                    <input type="hidden" name="idCliente" id="idCliente">
                            </div>
                        </div>
                        <!-- INPUT DE DOCUMENTO DE IDENTIDAD -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="number" min="0" class="form-control input-lg" name="editarDocumentoId"
                                    id="editarDocumentoId" required>
                            </div>
                        </div>
                        <!-- INPUT DE EMAIL DE CLIENTE -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" class="form-control input-lg" name="editarEmail" id="editarEmail"
                                    required>
                            </div>
                        </div>
                        <!-- INPUT DE TELÉFONO DE CLIENTE -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control input-lg" name="editarTelefono"
                                    id="editarTelefono" data-inputmask="'mask':'(999) 9999-9999'" data-mask required>
                            </div>
                        </div>
                        <!-- INPUT DE DIRECCIÓN DE CLIENTE -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input type="text" class="form-control input-lg" name="editarDireccion"
                                    id="editarDireccion" required>
                            </div>
                        </div>
                        <!-- INPUT DE FECHA DE NACIMIENTO DE CLIENTE -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control input-lg" name="editarFechaNacimiento"
                                    id="editarFechaNacimiento" data-inputmask="'alias':'yyyy/mm/dd'" data-mask required>
                            </div>
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
            $editarCliente = new ControladorClientes();
            $editarCliente->ctrEditarCliente();
            ?>
        </div>
    </div>
</div>

<?php
    $eliminarCliente = new ControladorClientes();
    $eliminarCliente->ctrEliminarCliente();
    ?>