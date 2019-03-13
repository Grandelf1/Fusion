<?php
$active_group = "cms";
$active_record = TRUE;

$db["cms"]["hostname"] = "127.0.0.1";
$db["cms"]["username"] = "root";
$db["cms"]["password"] = "";
$db["cms"]["database"] = "fusion";
$db["cms"]["port"] 	   = 3306;
$db["cms"]["dbdriver"] = "mysqli";
$db["cms"]["dbprefix"] = "";
$db["cms"]["pconnect"] = TRUE;
$db["cms"]["db_debug"] = TRUE;
$db["cms"]["cache_on"] = FALSE;
$db["cms"]["cachedir"] = "";
$db["cms"]["char_set"] = "utf8";
$db["cms"]["dbcollat"] = "utf8_general_ci";
$db["cms"]["swap_pre"] = "";
$db["cms"]["autoinit"] = TRUE;
$db["cms"]["stricton"] = FALSE;

$db["account"]["hostname"] = "127.0.0.1";
$db["account"]["username"] = "root";
$db["account"]["password"] = "";
$db["account"]["database"] = "trinity_auth_335";
$db["account"]["port"]     = 3306;
$db["account"]["dbdriver"] = "mysqli";
$db["account"]["dbprefix"] = "";
$db["account"]["pconnect"] = TRUE;
$db["account"]["db_debug"] = TRUE;
$db["account"]["cache_on"] = FALSE;
$db["account"]["cachedir"] = "";
$db["account"]["char_set"] = "utf8";
$db["account"]["dbcollat"] = "utf8_general_ci";
$db["account"]["swap_pre"] = "";
$db["account"]["autoinit"] = FALSE;
$db["account"]["stricton"] = FALSE;


$config = [

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */
    'connections' => [
        'fusion' => [
            'driver' => 'mysql',
            'host' => '127.0.0.1',
            'port' => '3306',
            'database' => 'fusion',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
        ],
    ]
];

/*
|--------------------------------------------------------------------------
| Database Setup
|--------------------------------------------------------------------------
|
| Setup the connections defined in the config and boot Eloquent,
| which will be used throughout the application.
|
*/

$capsule = new Illuminate\Database\Capsule\Manager();

foreach ($config['connections'] as $connection) {
    foreach ($connection as $settings) {
        $capsule->addConnection([
            'driver'    => $settings['driver'],
            'host'      => $settings['host'],
            'database'  => $settings['database'],
            'username'  => $settings['username'],
            'password'  => $settings['password'],
            'charset'   => $settings['charset'],
            'collation' => $settings['collation']
        ], $connection);
    }
}

// Set this instance as the global instance.
$capsule->setAsGlobal();

// Boot up Eloquent.
$capsule->bootEloquent();
