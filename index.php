<?php
session_start();
require(__DIR__ . '/vendor/autoload.php');

$db = new PDO('mysql:host=localhost;dbname=comments_test', 'root', '12345');

$registry = new \app\core\Registry();
$view = new \app\core\View();
$router = new \app\core\Router($registry);
try {
    $registry->set('db', $db);
    $registry->set('view', $view);
    $registry->set ('router', $router);
} catch (Exception $e) {
    echo $e->getMessage();
}

try {
    echo $router->run();
} catch (Exception $e) {
    echo $e->getMessage();
}