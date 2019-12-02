<?php
declare(strict_types=1);

chdir(dirname(__DIR__));
require 'vendor/autoload.php'; 

use DI\ContainerBuilder;
use SimpleMVC\Controller\ErroController; //pagina di erro
use Zend\Diactoros\ServerRequestFactory;

$builder = new ContainerBuilder();
$builder->addDefinitions('config/container.php');
$container = $builder->build();

$request = ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

// Routing
$path   = $request->getUri()->getPath();
$method = $request->getMethod();
$murl   = sprintf("%s %s", $method, $path);

$routes = require 'config/route.php';
//classe ErroController in caso de url sbagliata o inesistente chiama pagina di errore 404
$controllerName = $routes[$murl] ?? ErroController::class;

$controller = $container->get($controllerName);
$controller->execute($request);

