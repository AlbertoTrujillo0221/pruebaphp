<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <!--<![endif]-->
<html class="no-js" lang=""> 
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Perfil TICS - Producto</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" href="apple-touch-icon.png">
  <!-- Include Bootstrap Css -->
  <link rel="stylesheet" href="{{ asset('index-blog/css/bootstrap.min.css') }}">
  <!-- Include Bootstrap Min Css -->
  <link rel="stylesheet" href="{{ asset('index-blog/css/bootstrap-theme.min.css') }}">
  <!-- Include Fontawesome Min Css -->
  <link rel="stylesheet" href="{{ asset('index-blog/css/font-awesome.min.css') }}">
  <!-- Include Flaticon Css -->
  <link rel="stylesheet" href="{{ asset('index-blog/css/flaticon.css') }}">
  <!-- Include Style Css -->
  <link rel="stylesheet" href="{{ asset('index-blog/css/style.css') }}">
  <!-- Include Responsive Css -->
  <link rel="stylesheet" href="{{ asset('index-blog/css/responsive.min.css') }}">
  <!-- Include Modernizer Js -->
  <script src="{{ asset('index-blog/js/modernizr-2.8.3-respond-1.4.2.min.js') }}"></script>
  <!-- Logo Barra de Direcciones -->
  <link rel="icon" type="image/png" href="{{ asset('logo.png') }}" />
</head>
<body class="blog-single-post">

  <!-- Header Section -->
  @extends('layouts.layoutheader')
  <!-- Header Section -->

  <!-- Page Head -->

  <section id="page-head" class="page-head text-center page-back-tienda" data-stellar-background-ratio="0.1" data-stellar-vertical-offset="0">
    <div class="head-overlay">
      <div class="section-padding">
        <div class="container">
          <!--<h1 class="page-title">Bienvenidos a <span>Perfil TICS</span> Tienda Virtual</h1>/.page-title -->
          <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
        </div><!-- /.container -->
      </div><!-- /.section-padding -->
    </div><!-- /.head-overlay -->
  </section><!-- /#page-head -->

  <!-- Page Head -->

  <!-- Main Content Section -->

  <section id="main-content" class="main-content">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <?php foreach ($t004_productos as $t004_producto) { ?>
            <article class="post type-post">
              <div class="post-head media">
                <div class="media-body">
                  <h2 class="entry-title"><?php echo $t004_producto->f004_nombre; ?></h2><!-- /.entry-title -->
                  <div class="post-meta">
                    <div class="entry-meta">
                      <div class="author pull-left">
                        Por <span class="author-name">Administrador</span>
                      </div><!-- /.author -->
                    </div><!-- /.entry-meta -->
                  </div><!-- /.post-meta -->
                </div>
              </div><!-- /.post-head -->

              <div class="post-content">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                  </ol>
                  <div class="carousel-inner">
                    <div class="item active">
                      <img src="{{ asset('tienda/imagenes/'.$t004_producto->f004_foto_1) }}" alt="post Image">
                    </div>
                    <div class="item">
                        <img src="{{ asset('tienda/imagenes/'.$t004_producto->f004_foto_2) }}" alt="post Image">
                    </div>
                    <div class="item">
                        <img src="{{ asset('tienda/imagenes/'.$t004_producto->f004_foto_3) }}" alt="post Image">
                    </div>
                  </div>
                  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Anterior</span>
                  </a>
                  <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Siguiente</span>
                  </a>
                </div>
                <div class="entry-content">
                  <p>
                    <?php echo $t004_producto->f004_descripcion; ?>
                  </p>
                </div><!-- /.entry-content -->
              </div><!-- /.post-content -->
            </article><!-- /.type-post -->
          <?php } ?>

          <?php foreach ($t004_productos as $t004_producto) { ?>
            <div id="respond" class="comment-respond">
              <h3 class="title">¿Deseas Comprarlo? Dejanos tu mensaje y te contactaremos!</h3>
              <form action="{{ url('peticioncompra') }}" method="post" id="comment-form" class="comment-form">
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                <input type="hidden" name="producto" id="producto" value="<?php echo $t004_producto->f004_id_producto; ?>">
                <input type="email" name="email" id="email" class="email form-control" placeholder="Email" required>
                <br/>
                <textarea name="mensaje" id="mensaje" class="message form-control" cols="10" rows="5" placeholder="Tu Mensaje" required=""></textarea>
                <button type="submit" name="submit" id="submit" class="btn submit pull-right">Enviar</button>
              </form><!-- /#comment-form -->
            </div><!-- /#respond -->
          <?php } ?>
          <nav class="window-location text-center"></nav>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container -->
  </section><!-- /#main-content -->

  <!-- Main Content Section -->

  <!-- Footer Section -->
  @extends('layouts.layoutfooter')
  <!-- Footer Section -->


  <div id="scroll-to-top" class="scroll-to-top">
    <span>
      <i class="fa fa-chevron-up"></i>    
    </span>
  </div><!-- /#scroll-to-top -->




  <!-- Include jQuery Js -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <!-- Include jQuery Js -->
  <script>window.jQuery || document.write('<script src="{{ asset('index-blog/js/jquery-1.11.2.min.js') }}"><\/script>')</script>
  <!-- Include Plugins Js </-->
  <script src="{{ asset('index-blog/js/custom.min.js') }}"></script>
  <!-- Include WOW Min Js -->
  <script src="{{ asset('index-blog/js/wow.min.js') }}"></script>
  <!-- Include Waypoint Js -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>

</body>
</html>
