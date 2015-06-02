<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Web_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('user_model');
    }

    function index_post(){
        $loggedIn = $this->user_model->login($this->input->post());
        if(!$loggedIn){
            $this->_toast('Login is not valid');
        }
    }
}