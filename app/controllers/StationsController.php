<?php

namespace app\controllers;


use app\config\Constants;
use app\utils\StationConverter;

class StationsController extends BaseController
{
    public function getAllStations($request, $response, $args)
    {
        $sendResponse = $this->setCORSHeaders($response);
        return $sendResponse->withJson(json_decode(file_get_contents(Constants::STATIONS_JSON)));
    }

    public function convertStation($request, $response, $args)
    {
        $sendResponse = $this->setCORSHeaders($response);

        if (is_numeric($args["station"]))
            $station = StationConverter::fromInteger($args["station"]);
        else
            $station = StationConverter::fromString($args["station"]);

        if (count($station) > 0) {
            return $sendResponse->withJson($station);
        }

        return $sendResponse->withJson([
            "status" => 400,
            "message" => "Station doesn't exists"
        ], 400);
    }
}