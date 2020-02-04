<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Rutas de Index
Route::get('/','DatosIndexcontroller@cargarDatosIndex');
Route::post('enviaremail','DatosIndexcontroller@enviarEmail');
Route::post('suscribirse','DatosIndexcontroller@sucribirseAhora');

//Rutas de Tienda Virtual
Route::get('tiendavirtual/{pvIntCategoria}','DatosTiendaController@cargarDatosTiendaPrincipal');
Route::get('producto/{pvIntId_producto}','DatosTiendaController@cargarDatosTiendaDetallado');
Route::post('peticioncompra','DatosTiendaController@enviarSolicitudCompra');

//Rutas de Administrador
//Categorias
Route::get('admintiendacategoria','AdministradorController@admintiendacategoria');
Route::post('guardarcategoria','AdministradorController@GuardarCategoria');
Route::get('admineliminarcategoria','AdministradorController@admineliminarCategoria');
Route::get('adminmodificarcategoria/{pvIntIdCategoria}','AdministradorController@adminModificarCategoria');
Route::post('modificarcategoria','AdministradorController@modificarcategoria');
Route::get('eliminarcategoria','AdministradorController@eliminarcategoria');

Route::post('crearusuario','AdministradorController@registrarUsuario');
Route::post('coorporativo','AdministradorController@validarUsuario');
Route::post('guardarproducto','AdministradorController@GuardarProducto');
//Route::post('guardararchivo','AdministradorController@GuardarArchivo');
Route::get('adminprincipal','AdministradorController@adminprincipal');
Route::get('admintienda','AdministradorController@admintienda');
Route::get('mensajeleidocompra/{id_solicitud}','AdministradorController@cambiarEstadoEmailCompra');
Route::get('admineliminarproducto','AdministradorController@admineliminarproducto');
Route::get('adminlistarproducto','AdministradorController@adminListarProducto');
Route::get('adminmodificarproducto/{pvIntIdProducto}','AdministradorController@adminModificarProducto');
Route::post('modificarproducto','AdministradorController@modificarproducto');
Route::get('eliminarproducto','AdministradorController@eliminarproducto');
