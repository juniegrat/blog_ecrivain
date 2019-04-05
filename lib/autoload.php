<?php
function autoload($classname)
{
    if (file_exists($file = __DIR__ . '/' . $classname . '.php')) {
        var_dump($file);
        require $file;
    }
}

spl_autoload_register('autoload');
