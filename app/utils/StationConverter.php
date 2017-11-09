<?php

namespace app\utils;


use app\config\Constants;

class StationConverter
{
    private static $stations = null;

    public static function fromInteger($integer)
    {
        if (self::$stations == null)
            self::$stations = json_decode(file_get_contents(Constants::STATIONS_JSON));

        foreach(self::$stations as $stationCode => $stationString) {
            if($stationCode == $integer)
                return ["station_code" => $stationCode, "station_name" => $stationString];
        }

        return [];
    }

    public static function fromString($string)
    {
        if (self::$stations == null)
            self::$stations = json_decode(file_get_contents(Constants::STATIONS_JSON));

        foreach(self::$stations as $stationCode => $stationString) {
            if($stationString === $string)
                return ["station_code" => $stationCode, "station_name" => $stationString];
        }

        return [];
    }
}