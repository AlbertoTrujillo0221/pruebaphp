<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class t004_productos extends Model
{
    protected $table='t004_productos';
	protected $primaryKey = 'f004_id_producto';
	protected $fillable = array('f004_nombre','f004_descripcion','f004_peso','f004_precio','f004_categoria','f004_foto_1','f004_foto_2','f004_foto_3');
	protected $hidden = ['created_at','updated_at']; 
}