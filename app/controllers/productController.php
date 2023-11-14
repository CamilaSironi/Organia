
 <?php

require_once './app/models/productModel.php';
require_once './app/models/category.model.php';
require_once './app/views/productView.php';
require_once './app/views/category.view.php';
require_once './app/helpers/authHelper.php';

class productController{

    private $modelProd;
    private $viewProd;
    private $catView;
    private $catModel;

    public function __construct(){
        $this->catView = new CategoryView();
        $this->modelProd = new productModel();
        $this->viewProd = new productView();
        $this->catModel = new CategoryModel();
    }

    public function showProducts(){     
        $products = $this->modelProd->getProducts();
        $this->viewProd->showProducts($products); 
    }

    public function showDetails($id){
        $products = $this->modelProd->getProduct($id);
        $this->viewProd->showDetails($products);
    }
    
    public function showAddForm(){
        AuthHelper::verify();
        $categories = $this->catModel->getAllCategories();
        $this->viewProd->showAddForm($categories);
    }  

    public function addProduct(){
        AuthHelper::verify();

        if(isset($_POST)){
            $name = $_POST['name'];  
            $category = $_POST['category'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
        }

        if(empty($name)||empty($category)||empty($price)||empty($quantity)){ 
            $this->catView->showError("Complete todos los campos");
            return;
        }

        $id = $this->modelProd->addProduct($name, $category, $price, $quantity);

        if($id){
            header('Location: ' . BASE_URL . 'productsList');
        } else {
            $this->catView->showError("Error al insertar el producto");
        }        
    }

    public function removeProduct($id){
        AuthHelper::verify();
        $this->modelProd-> deleteProduct($id);
        header('Location: ' . BASE_URL . 'productsList');
    }

    public function showInput($id){
        AuthHelper::verify();
        $categories = $this->catModel->getAllCategories();
        $this->viewProd->showInput($id, $categories);
    }  
    
    public function updateProduct($id){
        AuthHelper::verify();
        if(!empty($_POST['name'])&&!empty($_POST['category'])&&!empty($_POST['price'])){

            $name = $_POST['name'];
            $category = $_POST['category'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];

            $this->modelProd->updateProduct($name, $quantity, $price, $category, $id);
            header('Location: ' . BASE_URL . 'productsList');
        }            
    }
}
