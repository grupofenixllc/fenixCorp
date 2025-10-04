<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rutas Web
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar las rutas web para tu aplicación.  Estas
| rutas son cargadas por el RouteServiceProvider dentro de un grupo que
| contiene el middleware "web".  Ahora sólo se expone un endpoint simple
| como placeholder.
|
*/

Route::get('/', function () {
    return ['message' => 'FenixCorp API'];
});