  <!-- Header Section -->
  <link rel="stylesheet" href="{{ asset('index-blog/css/ventanaemergente.css') }}">

  <header id="masthead" class="masthead navbar navbar-default navbar-fixed-top">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-menu">
          <i class="fa fa-bars"></i>
        </button>
        <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('logo.png') }}" width="80%" alt="Site Logo" style="margin-top: -.85em"></a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <nav id="main-menu" class="collapse navbar-collapse pull-right">
        <ul class="nav navbar-nav">
          <li><a type="button" data-toggle="modal" data-target="#modalIngresar" href="#">Ingresar</a></li>
          <li><a type="button" data-toggle="modal" data-target="#modalRegistrar" href="#">Registrarme</a></li>
        </ul>
      </nav><!-- /.navbar-collapse -->
    </div><!-- /.container -->
  </header><!-- /#masthead -->

  <!-- Header Section -->


  <div id="modalIngresar" class="modal fade" role="dialog" style="margin-top:8em;">
    <div class="modal-dialog">
      <div class="login-page-a">
        <div class="form-a">
          <form action="{{ url('coorporativo') }}" method="post" class="login-form-a">
            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
            <input name="email_ingresar" id="email_ingresar" class="input-a" type="email" placeholder="Email"/>
            <input name="password_ingresar" id="password_ingresar" class="input-a" type="password" placeholder="Password"/>
            <button class="button-a">Ingresar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div id="modalRegistrar" class="modal fade" role="dialog" style="margin-top:8em;">
    <div class="modal-dialog">
      <div class="login-page-a">
        <div class="form-a">
          <form action="{{ url('crearusuario') }}" method="post" class="login-form-a">
            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
            <input name="nombres_registrar" class="input-a" type="text" placeholder="Nombres"/>
            <input name="apellidos_registrar" class="input-a" type="text" placeholder="Apellidos"/>
            <input name="email_registrar" class="input-a" type="email" placeholder="Email"/>
            <input name="celular_registrar" class="input-a" type="number" placeholder="Celular"/>
            <button class="button-a">Registrarme</button>
            <div id="alert" class="col-md-12 text-center"></div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    function cargarAlerta(){
      var UrlPagina = window.location.search.substring(1);
      var UrlVariables = UrlPagina.split('&');
  for (var i = 0; i < UrlVariables.length; i++) {
    var Parametros = UrlVariables[i].split('=');
    if (Parametros[0] == "alerta") {
      if (Parametros[1] == "Registro") {
        alert("Su registro ha sido satisfactorio!");
      }else if (Parametros[1] == "Error") {
        alert("Su email ya se encuentra registrado!");
      }else if (Parametros[1] == "Invalido") {
        alert("Email y/o Password Incorrectos!");
      }else if (Parametros[1] == "Registrarse") {
        alert("Su email no se encuentra registrado, por favor registrese!");
      }else if (Parametros[1] == "EmailEnviado") {
        alert("Su email fue enviado satisfactoriamente!");
      }else{
        alert("Se genero un error inesperado!");
      }
    }
  }
 return null;
    }
  </script>

 
  <script type="text/javascript">
    $('.message a').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});
  </script>