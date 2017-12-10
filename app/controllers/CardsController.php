<?php

namespace app\controllers;


use app\utils\Utils;

class CardsController extends BaseController
{
    private static $metroValenciaUrl = "https://www.metrovalencia.es/tools_consulta_tsc.php";

    public function getBalance($request, $response, $args)
    {
        $cardNumber = $args["cardNumber"];

        $postFields = [
            "tsc" => $cardNumber
        ];

        $curlResponse = Utils::curlPost(self::$metroValenciaUrl, "MetroVlcHorarios", $postFields);

        $document = new \DOMDocument();
        $document->loadHTML($curlResponse);

        $paragraphs = $document->getElementsByTagName("p");

        $data = $paragraphs->item($paragraphs->length - 1)->textContent;

        //TODO Check for several zones
        $cardZone = substr($data, 26, strpos($data, "Saldo") - 26);
        $cardBalance = substr($data, strpos($data, "viajes: ") + 8, strpos($data, "Recargar") - (strpos($data, "viajes: ") + 8));

        return $response->withJson([
            "cardNumber" => trim($cardNumber),
            "cardZones" => trim($cardZone),
            "cardBalance" => trim($cardBalance)
        ]);
    }
}