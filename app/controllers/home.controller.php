<?php

require_once "./app/views/home.view.php";

class HomeController{

    private $view;

    public function __construct(){
        $this->view = new HomeView();
    }

    public function showHome(){
        $this->view->renderHome();
    }
}