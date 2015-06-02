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
        if($this->validate($data) AND $this->getLogin($data)){
            $result = true;
        }
        return $result;
    }

    function getLogin($data){
        return $this->get_by([
            'email' => $data['email'],
            'password' => md5($data['password']),
        ]);
    }
}