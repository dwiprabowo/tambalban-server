<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web_Controller extends MY_Controller{

    const TWIG_EXT = ".html.twig";
    const TWIG_DIR = APPPATH."views".DS;
    const HTTP_METHODS = [
        'get', 'delete', 'post', 'put', 'options', 'patch', 'head'
    ];

    private $twig;
    private $var = [];
    private $request;

    private $toasts = [];

    function __construct(){
        parent::__construct();
        $this->_request();
        $this->_init();
    }

    function _request(){
        $this->request = new stdClass();
        $this->request->method = $this->_detect_method();
    }

    function _detect_method(){
        $method = strtolower($this->input->server('REQUEST_METHOD'));
        if(in_array($method, self::HTTP_METHODS)){
            return $method;
        }
        return 'get';
    }

    function _remap($object, $args){
        $requested_method = $object.'_'.$this->request->method;

        $call_method = false;
        if(method_exists($this, $requested_method)){
            $call_method = $requested_method;
        }elseif(method_exists($this, $object)){
            $call_method = $object;
        }

        if($call_method){
            call_user_func_array(
                [$this, $call_method]
                , $args
            );
        }
    }

    function _init(){
        $this->_initTwig();
        $this->form_validation->set_error_delimiters(
            '<label class="control-label">'
            , '</label>'
        );
        if(defined('ENABLE_PROFILER') AND ENABLE_PROFILER){
            $this->output->enable_profiler(true);
        }
    }

    function _initTwig(){
        $twigLoader = new Twig_Loader_Filesystem(self::TWIG_DIR);
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
            'base_url',
            'site_url',
            'set_value',
            'form_error'
        ];
    }

    function _render(){
        $view = $this->_viewPath().self::TWIG_EXT;
        if(file_exists(self::TWIG_DIR.$view)){
            $template = $this->twig->loadTemplate($view);
            echo $template->render($this->_var());
        }else{
            show_404();
        }
    }

    function _var($key = false, $value = false){
        if(!$key){
            return $this->var;
        }
        $this->var[$key] = $value;
    }

    function _viewPath(){
        return $this->router->fetch_class()
            .DS
            .$this->router->fetch_method();
    }

    function _toast($message = false, $type = "error"){
        return $this->_toastCore($message, $type);
    }

    function _toastFlash($message = false, $type = "error"){
        return $this->_toastCore($message, $type, false);
    }

    function _toastCore($message = false, $type = "error", $direct = true){
        if(!$message){
            return $this->toasts;
        }
        $toast = [
            'type' => $type,
            'message' => $message,
        ];
        if($direct){
            $this->toasts[] = $toast;
        }else{
            $toasts = [];
            if($this->session->flashdata('toast')){
                $toasts = $this->session->flashdata('toast');
            }
            $toasts[] = $toast;
            $this->session->set_flashdata('toast', $toasts);
        }
        return false;
    }
}