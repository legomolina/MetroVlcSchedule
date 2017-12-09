<?php

use app\controllers\CardsController;
use app\controllers\RoutesController;
use app\controllers\StationsController;

$app->get("/api/v1/routes", RoutesController::class . ":getRoute");

$app->get("/api/v1/stations", StationsController::class . ":getAllStations");
$app->get("/api/v1/stations/converter/{station}", StationsController::class . ":convertStation");

$app->get("/api/v1/card/balance", CardsController::class . ":getBalance");