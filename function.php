<?php


function classAutoLoader($class){

    $class = strtolower($class);

    $the_path = "my_oop/{$class}.php";

    if(is_file($the_path) && !class_exists($class)) {

        include $the_path;
    }

}
 

spl_autoload_register('classAutoLoader');









?>