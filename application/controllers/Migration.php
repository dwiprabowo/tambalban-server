<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration extends CLI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->library('migration');
    }

    public function index(){
        $this->migration->latest();
    }
}