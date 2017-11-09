<?php

namespace app\models;

class Route
{
    private $routeId;
    private $fromStation;
    private $toStation;
    private $date;
    private $init_hour;
    private $final_hour;
    private $duration;
    private $zoneTickets;
    private $journey;

    /**
     * Route constructor.
     * @param $routeId
     * @param $fromStation
     * @param $toStation
     * @param $date
     * @param $init_hour
     * @param $final_hour
     * @param $duration
     * @param $zoneTickets
     * @param $journey
     */
    public function __construct($routeId, $fromStation, $toStation, $date, $init_hour, $final_hour, $duration, $zoneTickets, $journey)
    {
        $this->routeId = $routeId;
        $this->fromStation = $fromStation;
        $this->toStation = $toStation;
        $this->date = $date;
        $this->init_hour = $init_hour;
        $this->final_hour = $final_hour;
        $this->duration = $duration;
        $this->zoneTickets = $zoneTickets;
        $this->journey = $journey;
    }
}