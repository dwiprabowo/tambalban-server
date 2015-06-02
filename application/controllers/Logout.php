<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends Web_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('user_model');
    }

    function index(){
        $this->user_model->logout();
        $this->_toastFlash('Successfully Logout!', 'success');
        redirect('login');
    }

}