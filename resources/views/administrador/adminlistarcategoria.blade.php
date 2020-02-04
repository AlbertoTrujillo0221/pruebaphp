<body onload="cargarAlertaProductos()">
  @extends('administrador.layouts.layoutheader')
  @section('contenido')
  <!-- page content -->
  <div class="right_col" role="main">
            <div class="">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Modificar Productos</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form id="comment-form" class="comment-form form-horizontal form-label-left" enctype="multipart/form-data">
                      <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                      <input type="hidden" name="ruta_descarga" value="index-blog/imagenes/blog/noticias" />
                      <div class="form-group">
                        <div>
                          <?php if($t001_categorias == null){ ?>
                            <div class="alert alert-success">
                              <strong>Ooh!</strong> No hay publicaciones en el momento.
                            </div>
                          <?php }else{ ?>
                            <div class="table-responsive">
                              <table class="table" >
                                <tr style="font-size:20px;" class="success" align="center">
                                  <td>Nombre</td>
                                  <td>Descripcion Corta</td>
                                  <td>Modificar</td>
                                </tr>
                              <?php } foreach ($t001_categorias as $t001_categoria) { ?>
                                <tr align="center">
                                  <td><?php echo $t001_categoria->f004_nombre ?></td>
                                  <td><?php echo $t001_categoria->f004_descripcion ?></td>
                                  <td><a href="{{ url('adminmodificarproducto', ['pvIntCategoria' => $t004_producto->f004_id_producto]) }}"><img src="{{asset('administrador/imagenes/eliminar.png') }}"></a></td>
                                </tr>
                              <?php } ?>
                            </table>
                          </div>
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