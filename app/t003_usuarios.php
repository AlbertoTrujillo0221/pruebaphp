<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class t003_usuarios extends Model
{
    protected $table='t003_usuarios';
	protected $primaryKey = 'f003_id_usuario';
	protected $guarded = array('f003_email', 'f003_ind_usuario');
	protected $fillable = array('f003_nombres', 'f003_apellidos', 'f003_password', 'f003_celular');
	protected $hidden = ['created_at','updated_at']; 
}