<?php

class productView{

    public function showProducts ($products){
        require 'templates/productList.phtml';
    }

    public function showDetails($products){
        require 'templates/productDetail.phtml';
    }    

    public function showAddForm($categories){
        require 'templates/formInsertProduct.phtml';
    }  
    
    public function showInput($id, $categories){
        require 'templates/product.input.phtml';
    }  
}