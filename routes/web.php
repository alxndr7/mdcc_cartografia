<?php

Route::get('/', function () {
    return view("auth/login");
});


// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->get('logout', 'Auth\LoginController@logout')->name('logout');

$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//$this->post('register', 'Auth\RegisterController@register');
//Route::post('registro','Usuarios@postRegistro')->name('registro_user');
    Route::group(['middleware' => 'auth'], function() {//YOHAN MODULOS
    Route::get('uit', 'configuracion\Oficinas_Uit@get_alluit')->name('uit'); // tabla..
    Route::get('list_uit', 'configuracion\Oficinas_Uit@index'); // tabla grilla uit
    Route::post('uit_save', 'configuracion\Oficinas_Uit@insert'); // ruta para guardar
    Route::post('uit_mod', 'configuracion\Oficinas_Uit@modif');
    Route::post('uit_quitar', 'configuracion\Oficinas_Uit@eliminar');

    Route::get('oficinas', 'configuracion\Oficinas_Uit@get_alloficinas')->name('oficinas'); // tabla grilla Clientes
    Route::get('list_oficinas', 'configuracion\Oficinas_Uit@index1'); // tabla grilla uit
    Route::post('oficinas_mod', 'configuracion\Oficinas_Uit@modif_ofi');
    Route::post('oficinas_insert_new', 'configuracion\Oficinas_Uit@oficinas_insert_new');
    Route::post('oficinas_delete', 'configuracion\Oficinas_Uit@oficinas_delete');
});

Route::get('/home', 'map/MapController@index')->name('home');



Route::group(['middleware' => 'auth'], function() {   
    /******************************      MANTENIMIENTO   USUARIOS ********************************************************/
    Route::get('list_usuarios', 'Usuarios@index'); // tabla grilla Usuarios
    Route::get('/usuarios', 'Usuarios@vw_usuarios_show')->name('usuarios'); //vw_usuarios
    Route::post('usuario_save', 'Usuarios@insert_Usuario');
    Route::post('usuario_update', 'Usuarios@update_Usuario');
    Route::post('usuario_delete', 'Usuarios@eliminar_usuario'); //eliminar usuario
    Route::get('usuarios_validar_user','Usuarios@validar_user');
    Route::get('usuarios_validar_dni','Usuarios@validar_dni');
    Route::get('get_datos_usuario','Usuarios@get_datos_usuario');
    Route::post('cambiar_foto_user','Usuarios@cambiar_foto_usuario');


    Route::get('$',function(){ echo 0;});//url auxiliar

    /******************** ********    MAP CONTROLLER   ******************  **********/
    Route::group(['namespace'=>'map'],function(){

        Route::get('/home', 'MapController@index')->name('home');
        Route::get('/getlimites', 'MapController@get_limites')->name('get.limites');
        Route::get('/getsectores', 'MapController@get_sectores')->name('get.sectores');
        Route::get('/get_hab_urb', 'MapController@get_hab_urb')->name('get.hab.urb');
        Route::get('/getmznas', 'MapController@get_manzanas')->name('get.manzanas');
        Route::post('/geogetmznas_x_sector', 'MapController@geogetmznas_x_sector');
        Route::post('/get_centro_sector', 'MapController@get_centro_sector');
        Route::post('/mznas_x_sector', 'MapController@mznas_x_sector');
        Route::post('/get_lotes_x_sector', 'MapController@get_lotes_x_sector');
        Route::post('/get_predios_rentas','MapController@get_predios_rentas');
        Route::post('guardar_documentos','MapController@guardar_documentos');
        Route::post('docs_hab_urb_cofopri','MapController@guardar_docs_cofopri');
        Route::post('docs_hab_urb_sin_datos','MapController@guardar_docs_sin_datos');
        Route::post('docs_hab_urb_prov','MapController@guardar_docs_prov');

    });



});




