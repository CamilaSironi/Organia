<?php

require_once './app/models/category.model.php';
require_once './app/controllers/API.controller.php';

class APICategoryController extends APIController {

    private $model;

    function __construct(){
        parent::__construct();
        $this-> model = new CategoryModel();
    }

    function get($params = []) {
        if(empty($params)){
            $categories = $this->model->getAllCategories();
            $this->view->response($categories, 200);
        } 
        else {
            $category = $this->model->getCategorybyId($params[':ID']);
            if(!empty($category)) {
                $this->view->response($category, 200);
            }
            else {
                $this->view->response(
                    ['La categoria con el id = ' . $params[':ID'] . ' no existe.']
                    , 404);
            }
        }
    }

    function delete($params = []) {
        $category = $this->model->getCategorybyId($params[':ID']);
        if($category) {
            $this->model->deleteCategory($params[':ID']);
            $this->view->response(['La categoria con el id = ' . $params[':ID'] . ' se eliminó correctamente.']
            , 200);
        }
        else {
            $this->view->response(
                ['La categoria con el id = ' . $params[':ID'] . ' no existe.']
                , 404);
        }
    }

    function create($params = []) {
        if(isset($_POST)){
            $body = $this-> getData();
        }
        if(empty($body->category_name)){
            $this->view->response(['Faltan completar campos'], 400);
            return;
        }

        $category_name = $body->category_name;

        $id = $this->model->insertCategory($category_name);
        
        if($id){
            $this->view->response(['La categoria con el id = ' . $id . ' se agregó correctamente.']
            , 201);
        }
    }

    function update($params = []) {
        $id = $params[':ID'];

        if (!empty($id)){
            $category = $this->model->getCategorybyId($id);
        }
        if($category) {
            $body = $this-> getData();
            $category_name = $body->category_name;

            $this->model->updateCategory($category_name, $id);
            $this->view->response(['La categoria con el id = ' . $params[':ID'] . ' se actualizó correctamente.']
            , 200);
        }
        else {
            $this->view->response(
                ['La categoria con el id = ' . $params[':ID'] . ' no existe.']
                , 404);
        }
    }

}