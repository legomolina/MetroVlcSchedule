<?php

namespace app\controllers;


abstract class BaseController
{
    protected $slimApp;

    public function __construct($app)
    {
        $this->slimApp = $app;
    }
}