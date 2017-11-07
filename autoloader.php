<?php

 spl_autoload_register(function($name){ // register given function as __autoload() implementation (autoloading)
    require_once('settings.php'); // include file
    $dir=['src/','src/model/'];
    for ($i=0; $i < count($dir); $i++) {
        if(file_exists($dir[$i].$name.'.php')) {
             require_once $dir[$i].$name.'.php'; // include each file with 'php' file extension
         }
    }
 });
