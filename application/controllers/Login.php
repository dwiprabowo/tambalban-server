<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Web_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('user_model');
        if($this->user_model->loggedIn()){
            redirect('dashboard');
        }
    }

    function index_post(){
        $loggedIn = $this->user_model->login($this->input->post());
        if(!$loggedIn){
            if(!validation_errors()){
                $this->_toast('Login is not valid');
            }
        }else{
            $this->_toastFlash('Successfully Login!', 'success');
            redirect('dashboard');
        }
    }
}