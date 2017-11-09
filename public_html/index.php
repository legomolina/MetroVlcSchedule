<?php

//Import classes
use app\controllers;
use app\config\Constants;
use app\config\Config;
use app\utils;

//If session is started here, you can access $_SESSION supervariable everywhere
session_start();

//Get Composer and custom autoloader and run them
require '../vendor/autoload.php';
require_once '../app/project_autoloader.php';
$autloader = new app\Autoloader();
spl_autoload_register(array($autloader, 'handle'));

//Configuration for Slim
$app = new \Slim\App(Config::getConfig());

//Include routes file
require '../app/routesInclude.php';

//Dependency injection via Slim Container
$container = $app->getContainer();

//Render views
$container['view'] = function ($container) {
    return new \Slim\Views\PhpRenderer('../app/views/');
};

$app->run();