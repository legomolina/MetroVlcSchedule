<?php

namespace app\models;


class Journey
{
    private $journeyId;
    private $journeyTrains;
    private $journeyFromStation;
    private $journeyToStation;
    private $journeyHours;

    /**
     * Journey constructor.
     * @param $journeyId
     * @param $journeyTrains
     * @param $journeyFromStation
     * @param $journeyToStation
     * @param $journeyHours
     */
    public function __construct($journeyId, $journeyTrains, $journeyFromStation, $journeyToStation, $journeyHours)
    {
        $this->journeyId = $journeyId;
        $this->journeyTrains = $journeyTrains;
        $this->journeyFromStation = $journeyFromStation;
        $this->journeyToStation = $journeyToStation;
        $this->journeyHours = $journeyHours;
    }
}