<?php

namespace app\models;

class Route implements \JsonSerializable
{
    private $routeId;
    private $fromStation;
    private $toStation;
    private $date;
    private $initHour;
    private $finalHour;
    private $duration;
    private $zoneTickets;
    private $journey;

    /**
     * Route constructor.
     * @param int $routeId
     * @param int $fromStation Origin station code
     * @param int $toStation Destination station code
     * @param string $date Date string with format dd/mm/yyyy
     * @param string $init_hour Hour string with format hh:mm
     * @param string $final_hour Hour string with format hh:mm
     * @param int $duration Duration of journey in minutes
     * @param string[] $zoneTickets Array of strings
     * @param \app\models\Journey[] $journey
     */
    public function __construct($routeId, $fromStation, $toStation, $date, $initHour, $finalHour, $duration, $zoneTickets, $journey)
    {
        $this->routeId = $routeId;
        $this->fromStation = $fromStation;
        $this->toStation = $toStation;
        $this->date = $date;
        $this->initHour = $initHour;
        $this->finalHour = $finalHour;
        $this->duration = $duration;
        $this->zoneTickets = $zoneTickets;
        $this->journey = $journey;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}