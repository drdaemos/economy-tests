<?php
/*$app->get('/news/{year}', null, array('controller' => 'news', 'action' => 'show3'));
$app->get('/news/{year}/{month}', null, array('controller' => 'news', 'action' => 'show2'));
$app->get('/news/{year}/{month}/{date}', null, array('controller' => 'news', 'action' => 'show1'));*/
$app->get('/api/{action}', null, array('controller' => 'api','action' => 'index'));
$app->get('/flats/{id}', null, array('controller' => 'flats', 'action' => 'show', 'id' => 1));
$app->get('/{ctrl}/{action}/{id}', null);
$app->get('/{ctrl}/{action}', null);
$app->get('/{action}', null, array('controller' => 'default'));
$app->get('/', null, array('controller' => 'default', 'action' => 'index'));
//$app->get('/', 'DefaultController::Index');
?>