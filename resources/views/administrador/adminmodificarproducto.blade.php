<body onload="cargarAlerta()">
  @extends('administrador.layouts.layoutheader')
  @section('contenido')
  <!-- page content -->
    <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Datos Personales</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Actualizacion de Datos</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form action="{{ url('modificarproducto') }}" method="post" id="comment-form" class="comment-form form-horizontal form-label-left" enctype="multipart/form-data">
                          <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                          <input type="hidden" name="ruta_descarga" value="tienda/imagenes" />
                          <input type="hidden" name="f004_id_producto" value="<?php echo $f004_id_producto; ?>" />
                          <div class="form-group">
                            <div class="col-md-12 col-sm-6 col-xs-12">
                              <input name="f004_nombre" type="text" required="true" class="form-control" placeholder="Nombre" value="<?php echo $f004_nombre; ?>">
                            </div>
                            <div class="col-md-12 col-sm-6 col-xs-12">
                              <br>
                              <select class="form-control" name="f004_categoria" required="true">
                                <option value="0">Seleccione Categoria</option>
                                <?php foreach ($t001_categorias as $t001_categoria) { ?>
                                  <option value="<?php echo $t001_categoria->f001_id_categoria ?>"><?php echo $t001_categoria->f001_nombre ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <br>
                              <input name="f004_peso" type="text" required="true" class="form-control" placeholder="Peso" value="<?php echo $f004_peso; ?>">
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <br>
                              <input name="f004_precio" type="text" required="true" class="form-control" placeholder="Valor" value="<?php echo $f004_precio; ?>">
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <br>
                              <textarea name="f004_descripcion" required="true" type="text" class="form-control" placeholder="Descripcion" rows="10"><?php echo $f004_descripcion; ?></textarea>
                            </div>
                          </div>
                          <div id="alerts"></div>
                          <div class="form-group">
                            <div class="">
                              <center>
                                <button type="submit" class="btn btn-success">Modificar Producto</button>
                              </center>
                            </div>
                          </div>
                        </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
    <!-- /page content -->
    @endsection
</body>