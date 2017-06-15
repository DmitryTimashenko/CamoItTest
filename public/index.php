<?php

spl_autoload_register(function ($className) {
    $filename = '../app/' . str_replace('\\' , DIRECTORY_SEPARATOR , $className) . '.php';
    if (false === stream_resolve_include_path($filename)) {
        throw new \Exception('File \''.$filename.'\' isn\'t found');
    }
    include_once $filename;
});

$app = new Core\App();
