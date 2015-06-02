<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AutoView{

    function run(){
        $CI =& get_instance();

        if(
            $CI->output->get_output() == '' 
            AND
            is_subclass_of($CI, 'Web_Controller')
        ){
            $CI->_render();
        }
    }
}
