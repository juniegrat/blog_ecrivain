<?php
spl_autoload_register(function ($class_name) {
    if (file_exists('./controller/' . $class_name . '.php')) {
        require_once './controller/' . $class_name . '.php';
    } elseif (file_exists('./models/' . $class_name . '.php')) {
        require_once './models/' . $class_name . '.php';
    }
});
