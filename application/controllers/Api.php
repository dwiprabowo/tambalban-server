<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends REST_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('user_model');
    }

    function user_get(){
        if(!$this->get('id')){
            $this->response(NULL, 400);
        }

        $user = $this->user_model->get($this->get('id'));

        if($user){
            $this->response($user, 200);
        }else{
            $this->response([
                'error' => 'User could not be found'
            ], 404);
        }
    }

    function user_login_post(){
        $result = [
            'message' => "login failed!"
        ];
        $login_info = $this->post();
        if($login_info['email'] AND $login_info['password']){
            $user = $this->user_model->get_by([
                'email' => $login_info['email'],
                'password' => md5($login_info['password']),
            ]);
            if($user){
                $this->session->set_userdata("login", true);
                $result = [
                    'message' => "successfully login!"
                ];
            }
        }
        $this->response($result, 200);
    }
}