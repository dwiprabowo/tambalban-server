<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('d')){
    function d(){
        $args = func_get_args();
        $return_value = false;
        $null_items = [];
        foreach($args as &$v){
            if($v === null){
                $return_value = true;
                $null_items[] = $v;
                continue;
            }
            ob_start();
            echo var_export($v);
            $v = ob_get_clean();
        }
        foreach ($null_items as $k => $v) {
            $key = array_search($v, $args);
            unset($args[$key]);
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
