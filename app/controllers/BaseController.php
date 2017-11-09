<?php
/**
 * Created by PhpStorm.
 * User: aluTarde
 * Date: 09/11/2017
 * Time: 19:48
 */

namespace app\controllers;


abstract class BaseController
{
    protected $slimApp;

    public function __construct($app)
    {
        $this->slimApp = $app;
    }
}