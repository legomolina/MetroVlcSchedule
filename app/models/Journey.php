<?php

namespace app\models;


class Journey implements \JsonSerializable
{
    private $journeyId;
    private $journeyTrains;
    private $journeyFromStation;
    private $journeyToStation;
    private $journeyHours;

    /**
     * Journey constructor.
     * @param int $journeyId
     * @param string[] $journeyTrains Array containing the name of journey's trains
     * @param int $journeyFromStation Journey origin station code
     * @param int $journeyToStation Journey destination station code
     * @param string[] $journeyHours Array containing all hours in format hh:mm
     */
    public function __construct($journeyId, $journeyTrains, $journeyFromStation, $journeyToStation, $journeyHours)
    {
        $this->journeyId = $journeyId;
        $this->journeyTrains = $journeyTrains;
        $this->journeyFromStation = $journeyFromStation;
        $this->journeyToStation = $journeyToStation;
        $this->journeyHours = $journeyHours;
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