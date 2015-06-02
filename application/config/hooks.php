<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/
$hook['post_controller'][] = [
    'class' => 'Toast',
    'function' => 'collect',
    'filename' => 'toast.php',
    'filepath' => 'hooks',
];
$hook['post_controller'][] = [
    'class' => 'AutoView',
    'function' => 'run',
    'filename' => 'autoview.php',
    'filepath' => 'hooks',
];
