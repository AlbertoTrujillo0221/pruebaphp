<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <!--<![endif]-->
<html class="no-js" lang=""> 
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Perfil TICS</title>
  <meta name="description" content="Polmo - One Page HTML5 Template By Jewel Theme">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" href="{{ asset('index-blog/imagenes/apple-touch-icon.png') }}">
  <!-- Include Bootstrap Css -->
  <link rel="stylesheet" href="{{ asset('index-blog/css/bootstrap.min.css') }}">
  <!-- Include Bootstrap Min Css -->
  <link rel="stylesheet" href="{{ asset('index-blog/css/bootstrap-theme.min.css') }}">
  <!-- Include Animate Min Css -->
  <link rel="stylesheet" href="{{ asset('index-blog/css/animate.min.css') }}">
  <!-- Include Fontawesome Min Css -->
  <link rel="stylesheet" href="{{ asset('index-blog/css/font-awesome.min.css') }}">
  <!-- Include Magnific PopUp Css -->
  <link rel="stylesheet" href="{{ asset('index-blog/css/magnific-popup.css') }}">
  <!-- bxSlider CSS file -->
  <link href="{{ asset('index-blog/css/jquery.bxslider.css') }}" rel="stylesheet" />
  <!-- Include Style Css -->
  <link rel="stylesheet" href="{{ asset('index-blog/css/style.css') }}">
  <!-- Include Responsive Css -->
  <link rel="stylesheet" href="{{ asset('index-blog/css/responsive.min.css') }}">
  <!-- Include Modernizer Js -->
  <script src="{{ asset('index-blog/js/modernizr-2.8.3-respond-1.4.2.min.js') }}"></script>
  <!-- Logo Barra de Direcciones -->
  <link rel="icon" type="image/png" href="{{ asset('logo.png') }}" />
</head>
<body onload="cargarAlerta()">

  <!-- Header Section -->
  @extends('layouts.layoutheader')
  <!-- Header Section -->

  <!-- Main Slider -->

  <section id="main-slider" class="main-slider text-center">
    <div class="head-overlay">
      <ul class="bxslider">
        <li>
          <div class="head-overlay">
            <img src="{{ asset('index-blog/imagenes/banners/banners1.jpg') }}"/>
          </div><!-- /.head-overlay -->
          <div class="slider-text">
            <div class="slide-inner">
              <h2 class="slider-title">Nuestra <span>Tienda Virtual</span> Te Sorprendera</h2>
              <p class="slide-description">PERFIL TICS tiene gran variedad de productos, ingresa a nuestra tienda y lo verás.</p>
            </div><!-- /.slide-inner -->
          </div><!-- /.slider-text -->
        </li>
      </ul>
    </div><!-- /.head-overlay -->
  </section><!-- /#main-slider --> 

  <!-- Main Slider -->

  <div class="clearfix"></div><!-- /.clearfix -->



  <!-- Portfolio Section -->

  <section id="portfolio" class="portfolio text-center">
    <div class="portfolio-bottom">
      <div class="section-padding">
        <div class="section-top wow animated fadeInUp" data-wow-delay=".5s">
          <h2 class="section-title">Tienda Virtual</h2><!-- /.section-title -->
          <p class="section-description">
            Encuentra todos los productos que necesitas, selecciona una categoria!
          </p><!-- /.section-description -->
        </div><!-- /.section-top -->
        <br/><br/>

        <div class="latest-projects wow animated fadeInUp" data-wow-delay=".5s">
          <div id="project-items" class="project-items">
            <?php foreach ($t001_categorias as $t001_categoria) { ?>
              <div class="item cat-1 cat-4">
                <a style="margin-right: 8px" href="{{ asset('imgcategorias/'.$t001_categoria->f001_foto) }}" class="image-popup-vertical-fit">
                  <img src="{{ asset('imgcategorias/'.$t001_categoria->f001_foto) }}" data-at2x="{{ asset('imgcategorias/'.$t001_categoria->f001_foto) }}" alt="Item Image">
                </a>
                <a href="{{ url('tiendavirtual', ['pvIntCategoria' => $t001_categoria->f001_id_categoria]) }}" class="btn load-more"><?php echo $t001_categoria->f001_nombre; ?></a>
                <div class="item-details">
                  <h3 class="project-title"><?php echo $t001_categoria->f001_nombre; ?></h3>
                </div><!-- /.item-details -->
              </div><!-- /.item -->
            <?php } ?>
          </div><!-- /#project-items -->
        </div><!-- /.latest-projects -->
      </div><!-- /.section-padding -->
    </div><!-- /.portfolio-bottom -->
  </section>

  <!-- Portfolio Section -->


  <!-- Subscribe Section -->

  <section id="subscribe-section" class="subscribe-section text-center" data-stellar-background-ratio="0.1" data-stellar-vertical-offset="0">
    <div class="bg-overlay">
      <div class="section-padding">
        <div class="container">
          <div class="wow animated fadeInUp" data-wow-delay=".5s">
            <h2 class="section-title">Se Vienen Las Promociones!</h2><!-- /.section-title -->
            <p class="section-description">
              Para obtener las ultimas promociones de nuestra tienda suscríbase ahora. Es totalmente gratuito.
            </p><!-- /.section-description -->

            <form action="{{ url('suscribirse') }}" method="post"  class="subscribe">
              <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
              <p class="alert-success"></p>
              <p class="alert-warning"></p>

              <div class="subscribe-hide">
                <input class="subscribe" type="email" id="subscribete" name="subscribete" required>
                <button  type="submit" id="subscribe-submit" class="btn">Suscríbete Ahora</button>
              </div><!-- /.subscribe-hide -->
            </form><!-- /.subscribe -->
          </div>
        </div><!-- /.container -->
      </div><!-- /.section-padding -->
    </div><!-- /.bg-overlay -->
  </section><!-- /#subscribe-section -->

  <!-- Subscribe Section -->




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
  <!-- Include WOW Min Js -->
  <script src="{{ asset('index-blog/js/wow.min.js') }}"></script>
  <!-- Google Maps Script -->
  <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
  <!-- Gmap3.js') }} For Static Maps -->
  <script src="{{ asset('index-blog/js/gmap3.js') }}"></script>
  <!-- Include Waypoint Js -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
  <!-- Include Ajax MailChimp Js. JS PARA UTILIZAR CORREOSS
  <script src="{{ asset('index-blog/js/jquery.ajaxchimp.min.js') }}"></script>
  -->
    <!-- Include Custom Js </-->
  <script src="{{ asset('index-blog/js/custom.min.js') }}"></script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-63948535-1', 'auto');
  ga('send', 'pageview');

</script>


  <script>
    $(".bxslider").bxSlider({auto:!0,preloadImages:"all",mode:"horizontal",captions:!1,controls:!0,pause:4000,speed:1200,onSliderLoad:function(){$(".bxslider>li .slide-inner").eq(1).addClass("active-slide"),$(".slide-inner.active-slide .slider-title").addClass("wow animated bounceInDown"),$(".slide-inner.active-slide .slide-description").addClass("wow animated bounceInRight"),$(".slide-inner.active-slide .btn").addClass("wow animated zoomInUp")},onSlideAfter:function(e,i,n){console.log(n),$(".active-slide").removeClass("active-slide"),$(".bxslider>li .slide-inner").eq(n+1).addClass("active-slide"),$(".slide-inner.active-slide").addClass("wow animated bounceInRight")},onSlideBefore:function(){$(".slide-inner.active-slide").removeClass("wow animated bounceInRight"),$(".one.slide-inner.active-slide").removeAttr("style")}}),$(document).ready(function(){function e(){return"ontouchstart"in document.documentElement}function i(){if("undefined"!=typeof google){var i={center:[3.451647,-76.531985],zoom:15,mapTypeControl:!0,mapTypeControlOptions:{style:google.maps.MapTypeControlStyle.DROPDOWN_MENU},navigationControl:!0,scrollwheel:!1,streetViewControl:!0};e()&&(i.draggable=!1),$("#googleMaps").gmap3({map:{options:i},marker:{latLng:[3.451647,-76.531985],options:{icon:"{{ asset('index-blog/imagenes/mapicon.png') }}"}}})}}$("#masthead #main-menu").onePageNav(),i()}),$("#contactform").on("submit",function(e){e.preventDefault(),$this=$(this),$.ajax({type:"POST",url:$this.attr("action"),data:$this.serialize(),success:function(){alert("Message Sent Successfully")}})});

  </script>
</body>
</html>