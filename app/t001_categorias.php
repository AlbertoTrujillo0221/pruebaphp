<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class t001_categorias extends Model
{
	protected $table='t001_categorias';
	protected $primaryKey = 'f001_id_categoria';
	protected $fillable = array('f001_nombre','f001_foto','f001_nivel');
	protected $hidden = ['created_at','updated_at']; 
}
