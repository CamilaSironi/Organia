<?php

class CategoryView{

    public function renderList($categories){
        require "./templates/category.list.phtml";
    }

    public function renderCategory($products){
        require "./templates/category.info.phtml";
    }
    
    public function showForm(){
        require "./templates/category.form.phtml";
    }
    
    public function renderInput($id){
        require "./templates/category.input.phtml";
    }

    public function showError($error) {
        require './templates/error.phtml';
    }
}
