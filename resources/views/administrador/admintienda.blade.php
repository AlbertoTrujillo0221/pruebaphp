    <body onload="cargarAlertaProductos()">
      @extends('administrador.layouts.layoutheader')
      @section('contenido')
      <!-- page content -->
              <div class="right_col" role="main">
                <div class="">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Tienda Virtual</h2>
                        <ul class="nav navbar-right panel_toolbox">
                          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                          </li>
                          <li><a class="close-link"><i class="fa fa-close"></i></a>
                          </li>
                        </ul>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                        <form action="{{ url('guardarproducto') }}" method="post" id="comment-form" class="comment-form form-horizontal form-label-left" enctype="multipart/form-data">
                          <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                          <input type="hidden" name="ruta_descarga" value="tienda/imagenes" />
                          <div class="form-group">
                            <div class="col-md-12 col-sm-6 col-xs-12">
                              <input name="nombre" type="text" class="form-control" placeholder="Nombre" required="true">
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <br>
                              <select class="form-control" name="categoria" required="true">
                                <option value="0">Seleccione Categoria</option>
                                <?php foreach ($t001_categorias as $t001_categoria) { ?>
                                  <option value="<?php echo $t001_categoria->f001_id_categoria ?>"><?php echo $t001_categoria->f001_nombre ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <br>
                              <input name="peso" type="text" class="form-control" placeholder="Peso" required="true">
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <br>
                              <input name="valor" type="text" class="form-control" placeholder="Valor" required="true">
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <br>
                              <input class="form-control" type="file" name="images[]" required="true"/>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <br>
                              <input class="form-control" type="file" name="images1[]" required="true"/>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <br>
                              <input class="form-control" type="file" name="images2[]" required="true"/>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <br>
                              <textarea name="desc_larga" type="text" class="form-control" placeholder="Descripcion" rows="10" required="true"></textarea>
                            </div>
                          </div>
                          <div id="alerts"></div>
                          <div class="form-group">
                            <div class="">
                              <center>
                                <button type="submit" class="btn btn-success">Agregar Producto</button>
                              </center>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /page content -->
      @endsection
    </body>