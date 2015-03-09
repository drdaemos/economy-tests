<?php
require_once 'AppLoader.php';
$app = Application::getInstance();
require_once 'AppRoutes.php';
$app->run();
?>