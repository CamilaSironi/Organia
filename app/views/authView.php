<?php

  class authView{
    public function showLogin(){
        require 'templates/login.phtml';
    }

    public function showAdminPanel(){
        require 'templates/panelAdmin.phtml';
    }
}