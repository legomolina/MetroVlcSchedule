<?php

namespace app\utils;


use app\config\Constants;

class StationConverter
{
    private static $stations = null;

    /**
     * Parses the station code in station_list.json
     * @link http://metrovlcschedule.dev/station_list.json
     * @param int $integer Station code
     * @return array Array containing the station_code and the station_name
     */
    public static function fromInteger($integer)
    {
        if (self::$stations == null)
            self::$stations = json_decode(file_get_contents(Constants::STATIONS_JSON));

        foreach(self::$stations as $stationCode => $stationString) {
            if($stationCode == $integer)
                return ["station_code" => (int)$stationCode, "station_name" => $stationString];
        }

        return [];
    }

    /**
     * Parses the station name in station_list.json
     * @link http://metrovlcschedule.dev/station_list.json
     * @param string $string Station name
     * @return array Array containing the station_code and the station_name
     */
    public static function fromString($string)
    {
        $matcher = new \Diff_SequenceMatcher("a", "b", null, []);

        if (self::$stations == null)
            self::$stations = json_decode(file_get_contents(Constants::STATIONS_JSON));

        foreach(self::$stations as $stationCode => $stationString) {
            $matcher->setSequences($stationString, $string);

            if($matcher->Ratio() > 0.6)
                return ["station_code" => (int)$stationCode, "station_name" => $stationString];
        }

        return [];
    }
}