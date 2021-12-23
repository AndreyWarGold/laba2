<?php
session_start();
require_once 'config/db.php';
require_once 'route/web.php';

//define controller and action
$controllerName = isset($_GET['controller']) ? $_GET['controller'] : 'index';
$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';
$id = isset($_GET['id']) ? $_GET['id'] : '0';

//завантажуємо об’єкт роутінга
$routing = new Route();
//завантажуємо об'єкт моделі
$db = new Db();
if($controllerName == "coments"){
$routing->loadPage($db, $controllerName, $actionName, $id);
}else{
	$routing->loadPage($db, $controllerName, $actionName);
}
