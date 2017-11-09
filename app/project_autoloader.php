<?php

namespace app;

class Autoloader
{
    public function handle($class)
    {
        $file = str_replace('\\', '/', '../' . $class . '.php');

        if(!file_exists($file)){
            throw new \Exception('Class ' . $file . ' doesn\'t exists');
        }

        include_once $file;
    }
}