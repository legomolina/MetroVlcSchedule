<?php

namespace app\utils;

use DateTime;

class Utils
{

    /**
     * Prints server Uri located in BASE_URL constant
     */
    public static function getServerUri()
    {
        echo (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
    }

    /**
     * Returns server Uri located in BASE_URL constant
     */
    public static function returnServerUri()
    {
        return (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
    }

    /**
     * Make a POST request to url via curl
     * @param string $url The url curl should make the request
     * @param string $userAgent Name curl sends as petitioner
     * @param array $postFields Fields curl will send on the request body
     * @return mixed The response curl gets
     */
    public static function curlPost($url, $userAgent, $postFields)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => $userAgent,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $postFields
        ]);

        $curlResponse = curl_exec($curl);
        curl_close($curl);

        return $curlResponse;
    }


    /**
     * Checks that given date has the format
     * @param string $date The date to check
     * @param string $format The format you want to check
     * @return bool True if given date has same format, false otherwise
     */
    public static function validateDate($date, $format = "d/m/Y")
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
}