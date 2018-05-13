<?php
define('SITE_KEY','klaud9test');
define('MARVEL_PUBLIC_KEY','c9f59522a878d608729e3053ba34c342');
define('MARVEL_PRIVATE_KEY','f8e8bf9372e7d144bf36a45600c6a5c955285da1');


$app['log.level'] = Monolog\Logger::ERROR;
$app['api.version'] = "v1";
$app['api.endpoint'] = "/api";

/**
 * SQLite database file
 */
$app['db.options'] = array(
    'driver' => 'pdo_sqlite',
    'path' => realpath(ROOT_PATH . '/app.db'),
);

/**
 * MySQL
 */
//$app['db.options'] = array(
//  "driver" => "pdo_mysql",
//  "user" => "root",
//  "password" => "root",
//  "dbname" => "prod_db",
//  "host" => "prod_host",
//);
