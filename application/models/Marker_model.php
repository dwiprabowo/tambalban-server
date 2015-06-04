<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marker_model extends MY_Model{

    protected $validate = [
        'lat' => [
            'field' => 'lat',
            'label' => 'Latitude',
            'rules' => 'required|numeric'
        ],
        'lng' => [
            'field' => 'lng',
            'label' => 'Longitude',
            'rules' => 'required|numeric'
        ],
    ];
}