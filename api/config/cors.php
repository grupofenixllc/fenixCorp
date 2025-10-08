<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    // ESTA ES LA LÍNEA QUE HEMOS CAMBIADO
    'allowed_origins' => ['http://localhost:5173'],
    //para producción: 'allowed_origins' => ['https://fenixcorp.com.ar', 'https://www.fenixcorp.com.ar'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    // Y NOS ASEGURAMOS DE QUE ESTA LÍNEA ESTÉ EN 'true'
    'supports_credentials' => true,

];