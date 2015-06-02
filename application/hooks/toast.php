<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Toast{

    function collect(){
        $CI =& get_instance();
        $toasts = $CI->_toast();
        if($CI->session->flashdata('toast')){
            $toasts = array_merge(
                $toasts
                , $CI->session->flashdata('toast')
            );
        }
        /* bug chrome prefetch */
        $toasts = array_map(
            "unserialize"
            , array_unique(
                array_map("serialize", $toasts)
            )
        );

        $count = 0;
        $timeout = 1000;
        foreach ($toasts as &$v) {
            $v['timeout'] = $count+=$timeout;
        }
        $CI->_var('toasts', $toasts);
    }
}
