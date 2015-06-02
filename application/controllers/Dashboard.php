<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Web_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('user_model');
        if(!$this->user_model->loggedIn()){
            $this->_toastFlash('Please Login first');
            redirect('login');
        }
    }
}