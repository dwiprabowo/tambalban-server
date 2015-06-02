<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends MY_Model{

    private $validate_login = [
        'email' => [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email',
        ],
        'password' => [
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required',
        ]
    ];

    function login($data){
        $result = false;
        $this->validate = $this->validate_login;
        if($this->validate($data)){
            $user = $this->getLogin($data);
            if($user){
                $result = true;
                $this->session->set_userdata('login', $user->id);
            }
        }
        return $result;
    }

    function logout(){
        $this->session->unset_userdata('login');
    }

    function getLogin($data){
        return $this->get_by([
            'email' => $data['email'],
            'password' => md5($data['password']),
        ]);
    }

    function loggedIn(){
        $loginInfo = $this->session->userdata('login');
        if($loginInfo){
            return true;
        }
        return false;
    }
}