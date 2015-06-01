<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web_Controller extends MY_Controller{

    private $twig;
    private $var = [];
    const TWIG_EXT = ".html.twig";

    function __construct(){
        parent::__construct();
        $this->_init();
    }

    function _init(){
        $this->_initTwig();
    }

    function _initTwig(){
        $twigLoader = new Twig_Loader_Filesystem(APPPATH."views");
        $this->twig = new Twig_Environment($twigLoader);
        $this->_generateTwigFilter();
    }

    function _generateTwigFilter(){
        foreach ($this->_twigFilter() as $k => $v) {
            if(is_string($v)){
                $filter = new Twig_Function($v, $v);
            }
            $this->twig->addFunction($filter);
        }
    }

    function _twigFilter(){
        return [
            'base_url'
        ];
    }

    function _render(){
        $template = $this->twig->loadTemplate(
            $this->_viewPath().self::TWIG_EXT
        );
        echo $template->render($this->_var());
    }

    function _var($key = false){
        if(!$key){
            return $this->var;
        }
    }

    function _viewPath(){
        return $this->router->fetch_class()
            .DS
            .$this->router->fetch_method();
    }
}