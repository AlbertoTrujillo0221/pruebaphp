<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class t006_suscriptores extends Model
{
    protected $table='t006_suscriptores';
	protected $primaryKey = 'f006_id_supscritor';
	protected $guarded = array('f006_correo');
	protected $fillable = array('f006_ind_activo');
	protected $hidden = ['created_at','updated_at']; 
}