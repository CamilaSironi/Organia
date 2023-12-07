<?php

require_once './app/models/productModel.php';
require_once './app/controllers/API.controller.php';

class APIProductController extends APIController {

    private $model;

    function __construct(){
        parent::__construct();
        $this-> model = new productModel();
    }

    function get($params = []) {
        if(empty($params)){

            $page = isset($_GET["page"]) && ($_GET["page"])>0 ? $_GET["page"] : 0;
            if(is_numeric($page)){
                $pageQuery = ' ';
                if($page != 0){
                    $limit = 3;
                    $inicio = ((int)$page - 1) * ((int)$limit);
                    $pageQuery = "LIMIT $inicio,$limit ";
                }
            } else{
                $this->view->response("Por favor seleccione un valor de página numérico" , 400);
                return;
            }

            $categoryId = isset($_GET["category_id"]) && !empty($_GET["category_id"]) ? $_GET["category_id"] : 0;
            if(is_numeric($categoryId)){
                $filterQuery = ' ';
                if($categoryId !=0){
                    $filterQuery = ' WHERE categories.category_id = ' . $categoryId;
                }
            } else{
                $this->view->response("Por favor seleccione un valor de categoria numerico" , 400);
                return;
            }
            
            $order = isset($_GET["order"]) && !empty($_GET["order"]) ? $_GET["order"] : false;
            $orderQuery = ' ';
            
            if($order == true){
                $orderQuery = ' ORDER BY product_id ';
            }
            
            $products = $this->model->getProducts($pageQuery, $filterQuery, $orderQuery);
            $this->view->response($products, 200);
        } 
        else {
            $product = $this->model->getProduct($params[':ID']);
            if(!empty($product)) {
                $this->view->response($product, 200);
            }
            else {
                $this->view->response(
                    ['El producto con el id = ' . $params[':ID'] . ' no existe.']
                    , 404);
            }
        }
    }

    function delete($params = []) {
        $product = $this->model->getProduct($params[':ID']);
        if($product) {
            $this->model->deleteProduct($params[':ID']);
            $this->view->response(['El producto con el id = ' . $params[':ID'] . ' se eliminó correctamente.']
            , 200);
        }
        else {
            $this->view->response(
                ['El producto con el id = ' . $params[':ID'] . ' no existe.']
                , 404);
        }
    }

    function create($params = []) {
        if(isset($_POST)){
            $body = $this-> getData();
        }

        if(empty($body->product_name) || 
           empty($body->product_stock) || 
           empty($body->product_price) ||
           empty($body->category_id))
        {
           $this->view->response(['Faltan completar campos'], 400);
           return;
        }

        $product_name = $body->product_name;
        $product_stock = $body->product_stock;
        $product_price= $body->product_price;
        $category_id = $body->category_id;
        
        $id = $this->model->addProduct($product_name, $category_id, $product_price, $product_stock);
       
        if($id){
            $this->view->response(['El producto con el id = ' . $id . ' se agregó correctamente.']
            , 201);
        }
    }

    function update($params = []) {
        $id = $params[':ID'];
        if(!empty($id)){
            $product = $this->model->getProduct($id);
        }
        if($product) {
            $body = $this-> getData();
            $product_name = $body->product_name;
            $product_stock = $body->product_stock;
            $product_price= $body->product_price;
            $category_id = $body->category_id;
            
            $this->model->updateProduct($product_name, $product_stock, $product_price, $category_id, $id);
            $this->view->response(['El producto con el id = ' . $id . ' se actualizó correctamente.']
            , 200);
        }
        else {
            $this->view->response(
                ['El producto con el id = ' . $id . ' no existe.']
                , 404);
        }
    }

}