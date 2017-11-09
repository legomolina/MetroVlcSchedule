<?php

use app\controllers\RoutesController;
use app\controllers\StationsController;

$app->get("/routes", RoutesController::class . ":getRoute");

$app->get("/stations", StationsController::class . ":getAllStations");
$app->get("/stations/converter/{station}", StationsController::class . ":convertStation");