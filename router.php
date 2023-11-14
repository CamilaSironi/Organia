<?php

require_once './app/controllers/category.controller.php';
require_once './app/controllers/home.controller.php';
require_once './app/controllers/productController.php';
require_once './app/controllers/authController.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

//TABLA DE RUTEO

//categories -->           category.controller--> showList();
//category/:ID->             category.controller--> showCategory(id);
//enter-category -->           category.controller--> addCategory();
//delete-category/:ID -->      category.controller--> deleteCategory(id);
//editar-cat/:ID -->     category.controller--> editCategory(id);
//productsList -->           productController--> showProducts();
//product-details/:ID->             productController--> showDetails(id);
//enterProduct -->           productController--> addProduct();
//removeProduct/:ID -->      productController--> removeProduct(id);
//edit-Product/:ID -->     productController--> updateProduct(id);
//login -->                 authController--> showLogin();
//auth -->                  authController--> auth();

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'home';
}

$params = explode('/', $action);

switch($params[0]){
    case 'home':
        $controller = new HomeController();
        $controller -> showHome();
        break;
    case 'productsList':
        $controller = new productController();
        $controller->showProducts();
        break;
    case 'product-details':
        $controller = new productController();
        $controller->showDetails($params[1]);
        break;
    case 'categories':
        $controller = new CategoryController();
        $controller->showList();
        break;
    case 'category':
        $controller = new CategoryController();
        $controller->showCategory($params[1]);
        break;
    case 'enter-category':
        $controller = new CategoryController();
        $controller->enterCategory();
        break;
    case 'add-category':
        $controller = new CategoryController();
        $controller->addCategory();
        break;
    case 'delete-category':
        $controller = new CategoryController();
        $controller->deleteCategory($params[1]);
        break;
    case 'editar-cat':
        $controller = new CategoryController();
        $controller->showInput($params[1]);
        break;
    case 'edit-category':
        $controller = new CategoryController();
        $controller->editCategory($params[1]);
        break;
    case 'enterProduct':
        $controller = new productController();
        $controller->showAddForm();
        break;
    case 'addProduct':
        $controller = new productController();
        $controller->addProduct();
        break;
    case 'removeProduct':
        $controller = new productController();
        $controller->removeProduct($params[1]);
        break;
    case 'edit-product':
        $controller = new productController();
        $controller->showInput($params[1]);
        break;
    case 'updateProduct':
        $controller = new productController();
        $controller->updateProduct($params[1]);
        break;
    case 'login':
        $controller = new authController();
        $controller->showLoginForm();
        break;
    case 'loginUser':
        $controller = new authController();
        $controller->login();
        break;
    case 'panel':
        $controller = new authController();
        $controller->showPanel();
        break;
    case 'logout':
        $controller = new authController();
        $controller->logout();
        break;
    default: 
        echo "404 Page Not Found";
        break;
}
?>