<?php

namespace app\controllers;


class RoutesController extends BaseController
{
    private static $metroValenciaUrl = "http://www.metrovalencia.es/horarios.php";

    public function getRoute() {
        $fromStation = 121;
        $toStation = 15;
        $date = "09/11/2017";
        $initHour = "00:00";
        $finalHour = "23:59";
        $calculate = 1;

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => self::$metroValenciaUrl,
            CURLOPT_USERAGENT => "MetroVlcHorarios",
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => [
                "origen" => $fromStation,
                "destino" => $toStation,
                "calcular" => $calculate,
                "fecha" => $date,
                "hini" => $initHour,
                "hfin" => $finalHour
            ]
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        var_dump($response);
    }
}