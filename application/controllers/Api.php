<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends REST_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('marker_model');
    }

    function markers_get(){
        $limit = $this->input->get('length');
        $offset = $this->input->get('start');

        if($this->input->get('limit')){
            $limit = $limit;
        }

        $result = ['error' => "Couln't find any data"];
        $status = 404;

        $field_data = [
            1 => 'id',
            2 => 'lat',
            3 => 'lng',
        ];

        $order = [
            'column' => 1,
            'dir' => 'asc',
        ];

        if($this->input->get('order') AND $this->input->get('order')[0]['column']){
            $order = $this->input->get('order')[0];
        }

        $markers = $this->marker_model
            ->limit($limit, $offset)
            ->order_by(
                $field_data[$order['column']]
                , $order['dir']
            )
            ->get_all();

        if($markers){
            $count = 0;
            foreach ($markers as &$v) {
                $v->no = ++$count;
            }
            $result = $markers;
            $status = 200;
        }

        if($this->input->get('datatables')){
            $records_count =$this->marker_model->count_all();
            $result = [ 
                "recordsFiltered" => $records_count,
                "recordsTotal" => $records_count,
                "draw" => $this->input->get('draw'),
                'data' => $result 
            ];
        }
        $this->response($result, $status);
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