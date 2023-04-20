<?php
session_start();
require("./Controllers/BaseController.php");
require("./Core/DataBase.php");
require("./Models/BaseModel.php");
$controllerName=ucfirst(strtolower($_GET['controller'] ?? 'User')).'Controller';
$action=$_GET["action"] ?? 'index';
//echo $controllerName;
require("./Controllers/${controllerName}.php");

$controllerObject= new $controllerName;

$controllerObject->$action();
?>
