<?php

namespace app\controllers;


use app\utils\Utils;

class CardsController extends BaseController
{
    private static $metroValenciaUrl = "https://www.metrovalencia.es/tools_consulta_tsc.php";

    private static $testCardNumber = "3462018238";

    public function getBalance($request, $response, $args)
    {
        if (!isset($_GET["card_number"])) {
            return $response->withJson([
                "status" => 400,
                "message" => "You must enter the card number"
            ], 400);
        }

        $cardNumber = filter_var($_GET["card_number"], FILTER_SANITIZE_NUMBER_INT);

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
        $cardQuantity = substr($data, strpos($data, "viajes: ") + 8, strpos($data, "Recargar") - (strpos($data, "viajes: ") + 8));

        echo $cardQuantity;
    }
}