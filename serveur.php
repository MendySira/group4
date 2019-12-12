<?php

$url = parse_url($_SERVER['REQUEST_URL'],PHP_URL_PATH);


if($url != '/' && file_exists(__DIR__.'/pubic'.$url)){
    
    return FALSE;
    
}

//$_SERVER['SCRIPT_NAME'] = '/index.php';

require_once __DIR__ .'/public/index.php';