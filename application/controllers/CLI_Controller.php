<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CLI_Controller extends MY_Controller{

    function __construct(){
        parent::__construct();
        if(!$this->input->is_cli_request()){
            return show_404();
        }
    }
}