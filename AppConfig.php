<?php
$config["debug"] = true;
$config["notFound"] = "DefaultController::NotFound";
$config["error"] = "DefaultController::Error";
$config["appName"] = '2003-2013 Economy Dynamics';
$config["author"] = 'drdaemos';
$config["twig"] = array("templates" => "views/", "cache" => "cache/", "extension" => ".twig");

$config["db"] = "development";

$db_production = array(    //TODO:Заполнить реальными данными
    'host' => 'localhost',
    'username' => 'vh63927_conflue',
    'password' => '9KWWuXt0',
    'db' => 'vh63927_conflue',
    'port' => 3306,
    'charset' => 'utf8'
);
$db_development = array(
    'host' => 'localhost',
    'username' => 'frwl_data',
    'password' => 'DJYEs486mqBWytLp',
    'db' => 'frwl_data',
    'port' => 3306,
    'charset' => 'utf8'
);
$config["dbConnections"] = array("production" => $db_production, "development" => $db_development);
?>