<?php
/*Cargar los archivos de configuracion */
require_once 'config/config.php';
require_once 'model/db.php';

if(!isset($_GET["controller"])) $_GET["controller"] = constant("DEFAULT_CONTROLLER");
if(!isset($_GET["action"])) $_GET["action"] = constant("DEFAULT_ACTION");

$controller_path = 'controller/'.$_GET["controller"].'.php';

/*Reviso si el controlar existe */
if(!file_exists($controller_path))
$controller_path = 'controller/'.constant("DEFAULT_CONTROLLER").'.php';

/*Cargo el controlar */
require_once $controller_path;
$controllerName = $_GET["controller"].'controller';
$controller = new $controllerName();

/*Chequeo si el metodo esta definido */
$dataToView["data"] = array();
if(method_exists($controller,$_GET["action"]))
$dataToView["data"] = $controller->{$_GET["action"]}();

/*Cargar las vistas */
require_once 'view/template/header.php';
require_once 'view/'.$controller->view.'.php';
require_once 'view/template/footer.php';
?>