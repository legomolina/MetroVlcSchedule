<?php

namespace app\controllers;


use app\config\Constants;
use app\utils\StationConverter;

class StationsController extends BaseController
{
    public function getAllStations($request, $response, $args)
    {
        $newResponse = $response->withJson(json_decode(file_get_contents(Constants::STATIONS_JSON)));
        return $newResponse;
    }

    public function convertStation($request, $response, $args)
    {
        if (is_numeric($args["station"]))
            $station = StationConverter::fromInteger($args["station"]);
        else
            $station = StationConverter::fromString($args["station"]);

        if (count($station) > 0) {
            $newResponse = $response->withJson($station);
            return $newResponse;
        }

        return $response->withJson([
            "status" => 400,
            "message" => "Station doesn't exists"
        ], 400);
    }
}