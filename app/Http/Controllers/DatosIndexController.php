<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use App\t001_categorias;
use App\t006_suscriptores;

class DatosIndexController extends Controller
{
  public function cargarDatosIndex(){
    try{
      $t001_categorias = DB::select('call sp_cons_categorias_hijas()');
      return view("index", compact('t001_categorias'));
    }catch(Exceptio $e){
      return null;
    }
  }

  public function sucribirseAhora(){
    extract($_POST);
    $t006_suscriptores = json_decode(t006_suscriptores::where(array('f006_correo' => $subscribete))->get());
    if($t006_suscriptores == null){
      $t006_suscriptores = new t006_suscriptores;
      $t006_suscriptores->f006_correo     = nl2br($subscribete);
      $t006_suscriptores->f006_ind_activo = '0';
      $t006_suscriptores->save();
      return redirect('/?alerta=Registro');
    }else{
      return redirect('/?alerta=Error');
    }
  }

  public function enviarEmail(){
    extract($_POST);
    date_default_timezone_set('America/Bogota');
    $fecha=date("Y-m-d H:i:s");
    $asunto='Solicitud General';
    $hola=Mail::send('emails.contactoemailgeneral',compact('nombres','email','mensaje') , function ($message) use ($asunto)
    {
      $message->subject($asunto);
      $message->subject($asunto);
      $message->to("alberto-trujillo-ch@hotmail.com");
      $message->cc("albertotrujillo0221@gmail.com");
      return redirect('/?alerta=EmailEnviado');
    });
    echo $hola;
  }
}