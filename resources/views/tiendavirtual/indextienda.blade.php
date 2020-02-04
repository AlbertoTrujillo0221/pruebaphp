<!doctype html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en-us"> <!--<![endif]-->
<head>
	<title>Perfil TICS</title>

  <!-- Meta -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
  <!-- CSS Global Compulsory -->
  <link rel="stylesheet" href="{{ asset('tienda/assets/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('tienda/assets/plugins/cube-portfolio/cubeportfolio/css/cubeportfolio.min.css') }}">
  <link rel="stylesheet" href="{{ asset('tienda/css/architecture.style-port.css') }}">
  <!-- Logo Barra de Direcciones -->
  <link rel="icon" type="image/png" href="{{ asset('logo.png') }}" />
</head>
<body>

  <!-- Header Section -->
  @extends('layouts.layoutheader')
  <!-- Header Section -->

  <!-- Page Head -->

  <section id="page-head" class="page-head text-center page-back-tienda" data-stellar-background-ratio="0.1" data-stellar-vertical-offset="0">
    <div class="head-overlay">
      <div class="section-padding">
        <div class="container">
          <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
          <!-- /.page-description -->
        </div><!-- /.container -->
      </div><!-- /.section-padding -->
    </div><!-- /.head-overlay -->
  </section><!-- /#page-head -->

  <!-- Page Head -->

<br/><br/>
<!--Projects Section-->
	<section id="projects">
    <div class="container">
      <div class="row">
    		<div class="container-fluid no-side-padding content-md">

    			<!-- Projects cube-portfolio/ what we did -->
    			<div id="grid-container">
    				<?php foreach ($t004_productos as $t004_producto) { ?>
    				<div class="cbp-item">
    					<!-- data-title attribute will be used to populate lightbox caption -->
    					<div class="cbp-caption">
    						<a data-title="" href="{{ url('producto/'.$t004_producto->f004_id_producto) }}">
    							<img style="margin-left: 5px" src="{{ asset('tienda/imagenes/'.$t004_producto->  f004_foto_1) }}" alt="">
    							<div class="popup-title">
    								<h3><?php echo $t004_producto->f004_nombre; ?></h3>
    							</div>
    						</a>
    					</div>
    				</div>
    				<?php } ?>
    			</div>
    		</div>
      </div>
    </div>
	</section>
  <br/><br/>
	<!--End of Projects Section-->

	  <!-- Footer Section -->
  @extends('layouts.layoutfooter')
  <!-- Footer Section -->



  <div id="scroll-to-top" class="scroll-to-top">
    <span>
      <i class="fa fa-chevron-up"></i>    
    </span>
  </div><!-- /#scroll-to-top -->

  </body>
</html>

	<!-- JS Global Compulsory -->
<script src="{{ asset('tienda/assets/plugins/jquery/jquery.min-port.js') }}"></script>
<script src="{{ asset('tienda/assets/plugins/cube-portfolio/cubeportfolio/js/jquery.cubeportfolio.min.js') }}"></script>
<script src="{{ asset('tienda/assets/assets/js/plugins/cube-portfolio-lightbox.js') }}"></script>
	
	<!--[if lt IE 10]>
	  <script src="{{ asset('tienda/assets/plugins/sky-forms-pro/skyforms/js/jquery.placeholder.min.js"></script>
	<![endif]-->

	  <!-- Include jQuery Js -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <!-- Include jQuery Js -->  
  <!-- Google Maps Script -->
  <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
  <!-- Gmap3.js') }} For Static Maps -->
  <script src="{{ asset('index-blog/js/gmap3.js') }}"></script>
  <script src="{{ asset('index-blog/js/wow.min.js') }}"></script>
  <!-- Include Waypoint Js -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
  <!-- Include Ajax MailChimp Js -->
  <script src="{{ asset('index-blog/js/jquery.ajaxchimp.min.js') }}"></script>
    <!-- Include Custom Js </-->
  <script src="{{ asset('index-blog/js/custom.min.js') }}"></script>


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js,'ga');

  ga('create', 'UA-63948535-1', 'auto');
  ga('send', 'pageview');

</script>


  <script>
    $(".bxslider").bxSlider({auto:!0,preloadImages:"all",mode:"horizontal",captions:!1,controls:!0,pause:4000,speed:1200,onSliderLoad:function(){$(".bxslider>li .slide-inner").eq(1).addClass("active-slide"),$(".slide-inner.active-slide .slider-title").addClass("wow animated bounceInDown"),$(".slide-inner.active-slide .slide-description").addClass("wow animated bounceInRight"),$(".slide-inner.active-slide .btn").addClass("wow animated zoomInUp")},onSlideAfter:function(e,i,n){console.log(n),$(".active-slide").removeClass("active-slide"),$(".bxslider>li .slide-inner").eq(n+1).addClass("active-slide"),$(".slide-inner.active-slide").addClass("wow animated bounceInRight")},onSlideBefore:function(){$(".slide-inner.active-slide").removeClass("wow animated bounceInRight"),$(".one.slide-inner.active-slide").removeAttr("style")}}),$(document).ready(function(){function e(){return"ontouchstart"in document.documentElement}function i(){if("undefined"!=typeof google){var i={center:[3.451647,-76.531985],zoom:15,mapTypeControl:!0,mapTypeControlOptions:{style:google.maps.MapTypeControlStyle.DROPDOWN_MENU},navigationControl:!0,scrollwheel:!1,streetViewControl:!0};e()&&(i.draggable=!1),$("#googleMaps").gmap3({map:{options:i},marker:{latLng:[3.451647,-76.531985],options:{icon:"{{ asset('index-blog/imagenes/mapicon.png') }}"}}})}}$("#masthead #main-menu").onePageNav(),i()}),$("#contactform").on("submit",function(e){e.preventDefault(),$this=$(this),$.ajax({type:"POST",url:$this.attr("action"),data:$this.serialize(),success:function(){alert("Message Sent Successfully")}})});

  </script>
