<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('d')){
    function d(){
        $args = func_get_args();
        $return_value = false;
        foreach($args as &$v){
            if($v === null){
                $return_value = true;
                continue;
            }
            ob_start();
            echo var_export($v);
            $v = ob_get_clean();
        }
        $content = implode(' <=> ', $args);
        if($return_value){
            return $content;
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
