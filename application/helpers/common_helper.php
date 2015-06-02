<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('d')){
    function d(){
        $args = func_get_args();
        foreach($args as &$v){
            ob_start();
            echo var_export($v);
            $v = ob_get_clean();
        }
        if(!is_cli()){
            echo "<pre>";
        }else{
            echo "\n";
        }
        echo implode(' <=> ', $args);
        if(!is_cli()){
            echo "</pre>";
        }else{
            echo "\n";
        }
    }
}
