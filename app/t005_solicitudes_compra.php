<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class t005_solicitudes_compra extends Model
{
    protected $table='t005_solicitudes_compra';
	protected $primaryKey = 'f005_id_solicitud_compra';
	protected $guarded = array('f005_fecha', 'f005_asunto', 'f005_mensaje', 'f005_usuario');
	protected $fillable = array('f005_ind_compra_leido');
	protected $hidden = ['created_at','updated_at']; 
}