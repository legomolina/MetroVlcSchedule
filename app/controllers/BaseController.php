<?php

namespace app\controllers;


abstract class BaseController
{
    protected $slimApp;

    public function __construct($app)
    {
        $this->slimApp = $app;
    }

    protected function setCORSHeaders($response)
    {
        $res = $response->withHeader("Access-Control-Allow-Origin", "*")
        ->withHeader("access-control-allow-credentials", "true")
        ->withHeader("access-control-allow-headers", "Accept, Authorization, Origin, Content-Type, Retry-After")
        ->withHeader("access-control-allow-methods", "GET");

        return $res;
    }
}