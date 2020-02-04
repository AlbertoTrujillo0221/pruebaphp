<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\t003_usuarios;
use App\t004_productos;
use App\t001_categorias;
use App\t005_solicitudes_compra;

class AdministradorController extends Controller
{
  var $nombreimagen=null;
  var $nombreimagen_1=null;
  var $nombreimagen_2=null;

  public function cargarEmailsTotal() {
    $mensajesemailtotal = DB::select("SELECT COUNT(*) AS `f005_no_leidos` FROM `t005_solicitudes_compra` WHERE `f005_ind_compra_leido` = 0");
    return $mensajesemailtotal;
  }

  public function cargarEmailsCompra() {
    $mensajesemailcompra = DB::select("SELECT `f005_id_solicitud_compra`, `f005_fecha`, `f005_asunto`, `f005_mensaje`, `f005_usuario`, `f005_ind_compra_leido`, TIMESTAMPDIFF(MINUTE, `f005_fecha`, now()) AS `f005_minutos`, CONCAT(ltrim(rtrim(`usuarios`.`f003_nombres`)),' ',ltrim(rtrim(`usuarios`.`f003_apellidos`))) AS `f005_nombres` FROM `t005_solicitudes_compra` AS `solicitudes` INNER JOIN `t003_usuarios` AS `usuarios` ON `solicitudes`.`f005_usuario` = `usuarios`.`f003_id_usuario` WHERE `f005_ind_compra_leido`=0");
    return $mensajesemailcompra;
  }

  public function cambiarEstadoEmailCompra($id_solicitud){
    t005_solicitudes_compra::where('f005_id_solicitud_compra', $id_solicitud)
                    ->update(['f005_ind_compra_leido' => 1]);
    return back();
  }

  public function adminprincipal() {
    $mensajesemailtotal=$this->cargarEmailsTotal();
    $mensajesemailcompra=$this->cargarEmailsCompra();
    return view("administrador/indexadministrador", compact('mensajesemailtotal', 'mensajesemailcompra'));
  }

  public function admintienda() {
    $mensajesemailtotal=$this->cargarEmailsTotal();
    $mensajesemailcompra=$this->cargarEmailsCompra();
    $t001_categorias = DB::select('call sp_cons_categorias_hijas()');
    return view("administrador/admintienda", compact('t001_categorias', 'mensajesemailtotal','mensajesemailcompra'));
  }

  public function validarUsuario(Request $request) {
    extract($_POST);
    $t003_usuarios = t003_usuarios::where(array('f003_email' => $email_ingresar, 'f003_password' => $password_ingresar, 'f003_ind_usuario' => 1))->get();

    if($t003_usuarios != null){
      return redirect('adminprincipal');
    }else{
      return redirect('/?alerta=Invalido');
    }
  }

  public function registrarUsuario() {
    extract($_POST);
    $t003_usuarios = json_decode(t003_usuarios::where(array('f003_email' => $email_registrar))->get());
    if($t003_usuarios == null){
      $t003_usuarios = new t003_usuarios;
      $t003_usuarios->f003_nombres     = nl2br($nombres_registrar);
      $t003_usuarios->f003_apellidos   = nl2br($apellidos_registrar);
      $t003_usuarios->f003_password    = '';
      $t003_usuarios->f003_email       = nl2br($email_registrar);
      $t003_usuarios->f003_celular     = $celular_registrar;
      $t003_usuarios->f003_ind_usuario = '0';
      $t003_usuarios->save();
      return redirect('/?alerta=Registro');
    }else{
      return redirect('/?alerta=Error');
    }
  }

  public function GuardarProducto(Request $request) {
    extract($_POST);
    $varNombre=ltrim(rtrim($nombre));
    $varPeso=ltrim(rtrim($peso));
    $varPrecio=ltrim(rtrim($valor));
    $varDesc_larga=ltrim(rtrim($desc_larga));
    if ($varNombre=="") {
      return redirect('admintienda?alerta=IngreseNombre');
    }elseif ($categoria==0) {
      return redirect('admintienda?alerta=IngreseCategoria');
    }elseif ($varPeso=="") {
      return redirect('admintienda?alerta=IngresePeso');
    }elseif ($varPrecio=="") {
      return redirect('admintienda?alerta=IngreseValor');
    }elseif ($varDesc_larga=="") {
      return redirect('admintienda?alerta=IngreseDescLarga');
    }else{
      $validarimagen_1=$this->GuardarArchivo($request,1);
      $validarimagen_2=$this->GuardarArchivo($request,2);
      $validarimagen_3=$this->GuardarArchivo($request,3);

      if($validarimagen_1==true && $validarimagen_2==true && $validarimagen_3==true){
        date_default_timezone_set('America/Bogota');
        $fecha=date("Y-m-d H:i:s");

        $t004_productos = new t004_productos;
        $t004_productos->f004_nombre        = nl2br($nombre);
        $t004_productos->f004_descripcion   = nl2br($desc_larga);
        $t004_productos->f004_peso          = $peso;
        $t004_productos->f004_precio        = $valor;
        $t004_productos->f004_categoria     = $categoria;
        $t004_productos->f004_foto_1        = $this->nombreimagen;
        $t004_productos->f004_foto_2        = $this->nombreimagen_1;
        $t004_productos->f004_foto_3        = $this->nombreimagen_2;
        $t004_productos->save();

        return redirect('admintienda?alerta=PublicacionGuardada');
      }else{
        return redirect('admintienda?alerta=IngreseImagen');
      }
    }
  }

  public function GuardarArchivo(Request $request, $id_imagen) {
    if ($id_imagen==1) {
      $files = $request->file('images');
      // recorremos cada archivo y lo subimos individualmente
      if ($files==null) {
        return false;
      }
      foreach($files as $file) {
        $filename = $file->getClientOriginalName();
        $upload_success = $file->move($request->ruta_descarga, $filename);
      }
      $this->nombreimagen = $filename;
    }elseif ($id_imagen==2) {
      $files = $request->file('images1');
      if ($files==null) {
        return false;
      }
      // recorremos cada archivo y lo subimos individualmente
      foreach($files as $file) {
        $filename = $file->getClientOriginalName();
        $upload_success = $file->move($request->ruta_descarga, $filename);
      }
      $this->nombreimagen_1 = $filename;
    }elseif ($id_imagen==3) {
      $files = $request->file('images2');
      if ($files==null) {
        return false;
      }
      // recorremos cada archivo y lo subimos individualmente
      foreach($files as $file) {
        $filename = $file->getClientOriginalName();
        $upload_success = $file->move($request->ruta_descarga, $filename);
      }
      $this->nombreimagen_2 = $filename;
    }
    return $upload_success;
  }

  public function adminListarProducto() {
    extract($_GET);
    $mensajesemailtotal=$this->cargarEmailsTotal();
    $mensajesemailcompra=$this->cargarEmailsCompra();
    $t004_productos = json_decode(t004_productos::orderby('f004_id_producto', 'ASC')->get());
    return view("administrador/adminlistarproducto",compact('mensajesemailtotal','mensajesemailcompra','t004_productos'));
  }

  public function adminmodificarproducto($pvIntIdProducto) {
    extract($_GET);
    $mensajesemailtotal=$this->cargarEmailsTotal();
    $mensajesemailcompra=$this->cargarEmailsCompra();
    $t004_productos = json_decode(t004_productos::where(array('f004_id_producto' => $pvIntIdProducto))->get());
    $f004_id_producto = $t004_productos[0]->f004_id_producto;
    $f004_nombre      = $t004_productos[0]->f004_nombre;
    $f004_descripcion = $t004_productos[0]->f004_descripcion;
    $f004_peso        = $t004_productos[0]->f004_peso;
    $f004_precio      = $t004_productos[0]->f004_precio;
    $f004_categoria   = $t004_productos[0]->f004_categoria;

    $t001_categorias = json_decode(t001_categorias::where(array('f001_id_categoria' => $f004_categoria))->get());
    $f004_categoria = $t001_categorias[0]->f001_id_categoria;
    $t001_categorias = t001_categorias::all();

    return view("administrador/adminmodificarproducto",compact('mensajesemailtotal','mensajesemailcompra','f004_id_producto', 'f004_nombre', 'f004_descripcion', 'f004_peso', 'f004_precio', 'f004_categoria', 't001_categorias'));
  }

  public function modificarproducto() {
    extract($_POST);
    try{
      $t004_productos =
      t004_productos::where('f004_id_producto', '=', $f004_id_producto)
      ->update(array(
        'f004_nombre'      => $f004_nombre,
        'f004_descripcion' => $f004_descripcion,
        'f004_peso'        => $f004_peso,
        'f004_precio'      => $f004_precio,
        'f004_categoria'   => $f004_categoria,
    ));
      return redirect('adminlistarproducto?alerta=ProductoModificado');
    }catch(Exception $e){
      return redirect('adminlistarproducto?alerta=Error');
    }
  }

  public function admineliminarproducto() {
    extract($_GET);
    $mensajesemailtotal=$this->cargarEmailsTotal();
    $mensajesemailcompra=$this->cargarEmailsCompra();
    $t004_productos = json_decode(t004_productos::orderby('f004_id_producto', 'ASC')->get());
    return view("administrador/admineliminarproducto",compact('mensajesemailtotal','mensajesemailcompra','t004_productos'));
  }

  public function eliminarproducto() {
    extract($_GET);
    try{
      $t004_productos = t004_productos::where('f004_id_producto', $f004_id_producto)->delete();
      return redirect('admineliminarproducto?alerta=ProductoEliminado');
    }catch(Exception $e){
      return redirect('admineliminarproducto?alerta=Error');
    }
  }

  public function admintiendacategoria() {
    $mensajesemailtotal=$this->cargarEmailsTotal();
    $mensajesemailcompra=$this->cargarEmailsCompra();
    $t001_categorias = t001_categorias::orderby('f001_id_categoria', 'ASC')->get();
    return view("administrador/admintiendacategoria", compact('t001_categorias', 'mensajesemailtotal','mensajesemailcompra'));
  }

  public function GuardarCategoria(Request $request) {
    extract($_POST);
    $varNombre=ltrim(rtrim($nombre));
    if ($varNombre=="") {
      return redirect('admintiendacategoria?alerta=IngreseNombre');
    }else{
      $validarimagen_1=$this->GuardarArchivo($request,1);

      if($validarimagen_1==true){
        $t001_categorias = DB::select('call sp_obtener_categorias(?, ?, ?)',array(nl2br($nombre), $this->nombreimagen, $categoria));

        $f000_res = $t001_categorias[0]->f000_res;

        if($f000_res == 'TRUE'){
          return redirect('admintiendacategoria?alerta=CategoriaGuardada');
        }else{
          return redirect('admintiendacategoria?alerta=CategoriaNoGuardada');
        }
      }else{
        return redirect('admintiendacategoria?alerta=IngreseImagen');
      }
    }
  }

  public function admineliminarcategoria() {
    extract($_GET);
    $mensajesemailtotal=$this->cargarEmailsTotal();
    $mensajesemailcompra=$this->cargarEmailsCompra();
    $t001_categorias = json_decode(t001_categorias::orderby('f001_id_categoria', 'ASC')->get());
    return view("administrador/admineliminarcategoria",compact('mensajesemailtotal','mensajesemailcompra','t001_categorias'));
  }

  public function eliminarcategoria() {
    extract($_GET);
    try{
      $t001_categorias = t001_categorias::where('f001_id_categoria', $f001_id_categoria)->delete();
      return redirect('admineliminarcategoria?alerta=CategoriaEliminada');
    }catch(Exception $e){
      return redirect('admineliminarcategoria?alerta=Error');
    }
  }

}