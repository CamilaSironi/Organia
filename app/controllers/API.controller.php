<?php 

require_once './app/views/APIview.php';

abstract class APIController {

    protected $view;
    private $data;

    function __construct(){
        $this-> view = new APIview();
        $this-> data = file_get_contents('php://input');
    }

    function getData() {
        return json_decode($this->data);
    }

}