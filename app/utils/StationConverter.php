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
                return ["station_code" => (int)$stationCode, "station_name" => $stationString, "station_ratio" => 1];
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
        $bestStation = ["station_code" => 0, "station_name" => "", "station_ratio" => 0];

        $matcher = new \Diff_SequenceMatcher("a", "b", null, []);

        if (self::$stations == null)
            self::$stations = json_decode(file_get_contents(Constants::STATIONS_JSON));

        foreach(self::$stations as $stationCode => $stationString) {
            list($jsonStation, $searchedStation) = str_replace(['à', 'é', 'è', 'í', 'ò', 'ó', 'ú'], ['a', 'e', 'i', 'o', 'u'], [$stationString, $string]);

            $matcher->setSequences($jsonStation, $searchedStation);

            if($matcher->Ratio() > $bestStation["ratio"])
                $bestStation = ["station_code" => (int)$stationCode, "station_name" => $stationString, "station_ratio" => $matcher->Ratio()];
        }

        return $bestStation;
    }
}