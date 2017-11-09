<?php

namespace app\controllers;


class ConverterController extends BaseController
{
    public function convert($request, $response, $args) {
        $file = file_get_contents ("../app/utils/stations.json", "r");
        $stations = json_decode($file);

    }
}