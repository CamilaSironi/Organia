<?php

require_once "./app/views/category.view.php";
require_once "./app/models/category.model.php";
require_once "./app/models/productModel.php";
require_once './app/helpers/authHelper.php';

class CategoryController{

    private $model;
    private $view;

    public function __construct(){
        $this->model = new CategoryModel();
        $this->view = new CategoryView();
        $this->ProdModel = new productModel();
    }

    public function showList(){
        $categories = $this->model->getAllCategories();
        $this->view->renderList($categories);
    }

    public function showCategory($id){
        $products = $this->model->getCategorybyId($id);
        if(count($products)!=0)
            $this->view->renderCategory($products); 
        else $this->view->showError("No hay productos en esta categoría");
    }

    public function enterCategory(){
        AuthHelper::verify();
        $this->view->showForm();
    }

    public function addCategory(){
        authHelper::verify();
        if(isset($_POST)){
            $nombre = $_POST['nombre']; 
        }

        if(empty($nombre)){
            $this->catView->showError("Complete todos los campos");
            return;
        }


        $id = $this->model->insertCategory($nombre);

        if($id){
            header('Location: ' . BASE_URL . 'categories');
        } else {
            $this->catView->showError("Error al insertar el producto");
        }        
    }

    public function deleteCategory($id){
        authHelper::verify();
        $products = $this->model->getCategorybyId($id);
        if(count($products)!=0){
            for($i=0; $i<count($products); $i++)
                $this->ProdModel->deleteProductFromCategory($id);
        }
            $this->model->deleteCategory($id);
            header('Location: ' . BASE_URL . '/categories');
    }

    public function showInput($id){
        authHelper::verify();
        $this->view->renderInput($id);
    }

    public function editCategory($id){
        authHelper::verify();
        if(isset($_POST)){
            $value = $_POST['nombre']; 
            $this->model->updateCategory($value, $id);
        }
        header('Location: ' . BASE_URL . '/categories');
    }

}