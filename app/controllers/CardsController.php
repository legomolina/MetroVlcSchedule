<?php

namespace app\controllers;


use app\utils\Utils;

class CardsController extends BaseController
{
    private static $metroValenciaUrl = "https://www.metrovalencia.es/tools_consulta_tsc.php";

    public function getBalance($request, $response, $args)
    {
        $sendResponse = $this->setCORSHeaders($response);

        $cardNumber = $args["cardNumber"];
        $data = "";

        $postFields = [
            "tsc" => $cardNumber
        ];

        $curlResponse = Utils::curlPost(self::$metroValenciaUrl, "MetroVlcHorarios", $postFields);

        $document = new \DOMDocument();
        $document->loadHTML($curlResponse);

        $paragraphs = $document->getElementsByTagName("p");

        foreach($paragraphs->item($paragraphs->length - 1)->childNodes as $node) {
            if($node->nodeType === XML_TEXT_NODE )
                $data .= $node->textContent . "|||";
        }

        if(strpos($data, "Saldo") === false)
            return $sendResponse->withJson([
                "status" => 400,
                "message" => "Card doesn't exists"
            ], 400);

        list($cardZone, $cardBalance) = explode("|||", $data);

        $cardZone = explode(":", $cardZone)[1];
        $cardBalance = explode(":", $cardBalance)[1];

        return $sendResponse->withJson([
            "cardNumber" => trim($cardNumber),
            "cardZones" => trim($cardZone),
            "cardBalance" => trim($cardBalance)
        ]);
    }
}