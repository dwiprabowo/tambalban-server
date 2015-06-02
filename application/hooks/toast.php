<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Toast{

    function collect(){
        $CI =& get_instance();
        $CI->_var('toasts', $CI->_toast());
    }
}
