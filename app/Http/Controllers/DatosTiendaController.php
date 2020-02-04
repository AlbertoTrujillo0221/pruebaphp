<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\t004_productos;
use App\t005_solicitudes_compra;
use DB;
use Mail;

class DatosTiendaController extends Controller
{
	public function cargarDatosTiendaPrincipal($f001_id_categoria){
		extract($_GET);
		$t004_productos = t004_productos::where(array('f004_categoria' => $f001_id_categoria))->get();
	    return view("tiendavirtual/indextienda", compact('t004_productos'));
	}

  	public function cargarDatosTiendaDetallado($pvIntId_producto){
  		$t004_productos_json = t004_productos::where(array('f004_id_producto' => $pvIntId_producto))->get();
        $t004_productos = json_decode($t004_productos_json);
	    return view("tiendavirtual/unico-producto", compact('t004_productos'));
	}

	public function enviarSolicitudCompra(){
		extract($_POST);
		try{
			date_default_timezone_set('America/Bogota');
			$fecha=date("Y-m-d H:i:s");
			$consultarusuario = DB::select("SELECT `f003_id_usuario`, CONCAT(ltrim(rtrim(`f003_nombres`)),' ',ltrim(rtrim(`f003_apellidos`))) AS `f003_nombres`, `f003_email`, `f003_password` FROM `t003_usuarios` WHERE `f003_email`='".$email."'");
        	
        	$t004_productos = json_decode(t004_productos::where(array('f004_id_producto' => $producto))->get());
			if($consultarusuario != null){
				$usuario=$consultarusuario[0]->f003_nombres;
				$asunto='Solicitud de compra: '.$t004_productos[0]->f004_nombre;
				$email_send=$email;
	            $t005_solicitudes_compra = new t005_solicitudes_compra;
	            $t005_solicitudes_compra->f005_fecha			= $fecha;
	            $t005_solicitudes_compra->f005_asunto   		= $asunto;
	            $t005_solicitudes_compra->f005_mensaje  		= $mensaje;
	            $t005_solicitudes_compra->f005_usuario  		= $consultarusuario[0]->f003_id_usuario;
	            $t005_solicitudes_compra->f005_ind_compra_leido	= 0;
	            $t005_solicitudes_compra->save();

				Mail::send('emails.contactoemailcompra',compact('usuario','email','mensaje') , function ($message) use ($asunto)
				{
					$message->subject($asunto);
					$message->to("alberto-trujillo-ch@hotmail.com");
				});
				return redirect('/?alerta=EmailEnviado');
			}else{
				return redirect('/?alerta=Registrarse');
			}
		}catch(Exception $e){
			return redirect('/?alerta=ErrorCatch');
		}
	}
}