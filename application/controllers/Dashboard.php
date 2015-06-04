<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Web_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('marker_model');
        if(!$this->user_model->loggedIn()){
            $this->_toastFlash('Please Login first');
            redirect('login');
        }
    }

    function approve_post(){
        $this->marker_model->update(
            $this->input->post('id')
            , ['review' => 1]
            , true
        );
        $this->_toastFlash("Marker Accepted!", "success");
        redirect("dashboard");
    }

    function reject_post(){
        $this->marker_model->update(
            $this->input->post('id')
            , ['review' => 2]
            , true
        );
        $this->_toastFlash("Marker Rejected!");
        redirect("dashboard");
    }
}