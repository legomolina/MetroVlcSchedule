<?php

$app->get("/", "TestController:testMethod");
$app->get("/routes", "RoutesController:getRoute");
$app->get("/station-converter/{station}", "ConverterController:convert");