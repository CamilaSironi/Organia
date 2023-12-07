<?php
    require_once 'app/config.php';
    require_once 'libs/router.php';
    require_once 'app/controllers/API.category.controller.php';
    require_once 'app/controllers/API.product.controller.php';

    $router = new Router();

#                     endpoint      verb         controller           method
    $router->addRoute('categories', 'GET', 'APICategoryController', 'get');
    $router->addRoute('categories/:ID', 'GET', 'APICategoryController', 'get');
    $router->addRoute('categories',     'POST',   'APICategoryController', 'create');
    $router->addRoute('categories/:ID', 'PUT',    'APICategoryController', 'update');
    $router->addRoute('categories/:ID', 'DELETE', 'APICategoryController', 'delete');

    $router->addRoute('products', 'GET', 'APIProductController', 'get');
    $router->addRoute('products/:ID', 'GET', 'APIProductController', 'get');
    $router->addRoute('products',     'POST',   'APIProductController', 'create');
    $router->addRoute('products/:ID', 'PUT',    'APIProductController', 'update');
    $router->addRoute('products/:ID', 'DELETE', 'APIProductController', 'delete');
    
    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);