<?php

namespace app\controllers;


use app\models\Journey;
use app\models\Route;
use app\utils\StationConverter;
use app\utils\Utils;

class RoutesController extends BaseController
{
    private static $metroValenciaUrl = "http://www.metrovalencia.es/horarios.php";

    public function getRoute($request, $response, $args)
    {
        $sendResponse = $this->setCORSHeaders($response);

        if (!isset($_GET["from"])) {
            return $sendResponse->withJson([
                "status" => 400,
                "message" => "Origin station should be included"
            ], 400);
        }

        if (!isset($_GET["to"])) {
            return $sendResponse->withJson([
                "status" => 400,
                "message" => "Destination station should be included"
            ], 400);
        }

        if (!isset($_GET["date"]))
            $date = date("d/m/Y");
        else {
            $date = filter_var($_GET["date"], FILTER_SANITIZE_STRING);

            if (!Utils::validateDate($date, "d/m/Y")) {
                return $sendResponse->withJson([
                    "status" => 400,
                    "message" => "Date is not inserted with correct format dd/mm/yyyy"
                ], 400);
            }
        }

        if (!isset($_GET["ihour"]))
            $initHour = "00:00";
        else {
            $initHour = filter_var($_GET["ihour"], FILTER_SANITIZE_STRING);

            if (!Utils::validateDate($initHour, "H:i")) {
                return $sendResponse->withJson([
                    "status" => 400,
                    "message" => "Init hour is not inserted with correct format hh:mm"
                ], 400);
            }
        }

        if (!isset($_GET["fhour"]))
            $finalHour = "23:59";
        else {
            $finalHour = filter_var($_GET["fhour"], FILTER_SANITIZE_STRING);

            if (!Utils::validateDate($finalHour, "H:i")) {
                return $sendResponse->withJson([
                    "status" => 400,
                    "message" => "Final hour is not inserted with correct format hh:mm"
                ], 400);
            }
        }

        if ($initHour == $finalHour) {
            return $sendResponse->withJson([
                "status" => 400,
                "message" => "Init hour should be different from final hour"
            ], 400);
        }

        if($initHour > $finalHour) {
            return $sendResponse->withJson([
                "status" => 400,
                "message" => "Final hour should be greater than init hour"
            ], 400);
        }

        $fromStation = filter_var($_GET["from"], FILTER_SANITIZE_NUMBER_INT);
        $toStation = filter_var($_GET["to"], FILTER_SANITIZE_NUMBER_INT);

        if($fromStation == $toStation) {
            return $sendResponse->withJson([
                "status" => 400,
                "message" => "Origin station should be different from destination station"
            ], 400);
        }

        if(count(StationConverter::fromInteger($fromStation)) <= 0 ||
            count(StationConverter::fromInteger($toStation)) <= 0) {
            return $sendResponse->withJson([
                "status" => 400,
                "message" => "Origin or destination station doesn't exists"
            ], 400);
        }

        $calculate = 1;

        $postFields = [
            "origen" => $fromStation,
            "destino" => $toStation,
            "calcular" => $calculate,
            "fecha" => $date,
            "hini" => $initHour,
            "hfin" => $finalHour
        ];

        $curlResponse = Utils::curlPost(self::$metroValenciaUrl, "MetroVlcHorarios", $postFields);

        $document = new \DOMDocument();
        $document->loadHTML($curlResponse);

        $divs = $document->getElementsByTagName("div");

        $query = null;

        for ($i = 0; $i < $divs->length; $i++) {
            if ($divs->item($i)->getAttribute("class") == "consulta") {
                $query = $divs->item($i);
                break;
            }
        }

        if ($query == null) {
            return $sendResponse->withJson([
                "status" => 500,
                "message" => "An error has occurred with metrovalencia.es"
            ], 500);
        }

        $duration = "";
        $tickets = [];

        $data = $query->getElementsByTagName("li");

        /*
         * search for route duration and needed zone tickets
         */
        for ($i = 0; $i < $data->length; $i++) {
            /*
             * searching for route duration
             */

            //foreach li inside the query div checks if inside is written "Duración", if yes that's the one we need
            if (strpos($data->item($i)->nodeValue, "Duración") !== false) {
                //separate the text by spaces
                $parts = explode(' ', $data->item($i)->nodeValue);

                for ($j = 0; $j < count($parts); $j++) {
                    //we are looking for the part that ends with ":"
                    if (strrpos(trim($parts[$j]), ':') == strlen(trim($parts[$j])) - 1) {
                        //the duration is the next part
                        $duration = trim($parts[$j + 1]);
                        break;
                    }
                }
            }
            /*
             * searching for route zone tickets
             */

            //if not contains the duration, check if it has written inside "billete", if yes that's the one we need
            elseif (strpos($data->item($i)->nodeValue, "billete") !== false) {
                //separate the text by : because the line has text:tickets
                $parts = explode(':', $data->item($i)->nodeValue);

                //so we take the last part and then split it into chars and save them
                $tickets = str_split(trim($parts[count($parts) - 1]));
            }
        }

        /*
         * we know that there will be as many journeys as tables inside the query div because each table
         * contains the schedule for its journey
         */
        $data = $query->getElementsByTagName("table");
        $dataStations = $query->getElementsByTagName("span");
        $dataTrains = $query->getElementsByTagName("h3");
        $journeyCount = $data->length;

        $journeyFromStation = [];
        $journeyToStation = [];
        $hours = [];

        $journey = [];

        for ($i = 0; $i < $journeyCount; $i++) {
            /*
             * searching for journey stations
             */

            //checks if array is empty to avoid duplicates because it fills the array in the first iteration of the
            if (count($journeyFromStation) <= 0) {

                for ($j = 0; $j < $dataStations->length; $j++) {

                    //loops through all spans inside the query div and checks that it has the "texto_transbordo" class
                    if ($dataStations->item($j)->getAttribute("class") == "texto_transbordo") {
                        //saves the text inside the span
                        $text = $dataStations->item($j)->nodeValue;
                        $matches = [];

                        //the regex pattern checks for any text is between "De " and " a ", the fromStation
                        preg_match("/(?<=De\s)(.*)(?=\sa\s)/", $text, $matches);

                        //converts the station name to the station code
                        $journeyFromStation[] = StationConverter::fromString($matches[0])["station_code"];

                        //the toStation is the rest of the text from " a "
                        $journeyToStation[] = StationConverter::fromString(substr($text, strpos($text, " a ") + 3))["station_code"];
                    }
                }
            }

            /*
             * searching for trains you can take
             */

            //takes the $i h3 element and saves the content
            $trainsText = $dataTrains->item($i)->nodeValue;
            $parts = explode(':', $trainsText);

            //each train is separated by , so just need to explode the last part of the text
            $trains = explode(',', $parts[count($parts) - 1]);

            //loops through the trains to trim all strings
            for ($j = 0; $j < count($trains); $j++)
                $trains[$j] = trim($trains[$j]);

            /*
             * searching for schedule
             */

            //get rows from table
            $rows = $data->item($i)->getElementsByTagName("tr");

            //first row and first col are thrash data so I've jump them
            for ($x = 1; $x < $rows->length; $x++) {
                $cells = $rows->item($x)->getElementsByTagName("td");

                for ($y = 1; $y < $cells->length; $y++) {
                    $cell = $cells->item($y)->nodeValue;

                    //if the content of the cell is different to "---" it will be an hour
                    if (trim($cell) !== "---")
                        $hours[] = trim($cell);
                }
            }

            //construct the journey and add it to the array
            $journey[] = new Journey($i, $trains, $journeyFromStation[$i], $journeyToStation[$i], $hours);

            //reset variables
            $hours = [];
        }

        //create the route object
        $route = new Route(rand(0, 10), (int)$fromStation, (int)$toStation, $date, $initHour, $finalHour, (int)$duration, $tickets, $journey);

        //return the route object encoded
        return $sendResponse->withJson($route);
    }
}