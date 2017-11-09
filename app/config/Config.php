<?php

namespace app\config;


class Config
{
    const DISPLAY_ERROR_DETAILS = true; //set false in production
    const DETERMINE_ROUTE_BEFORE_APP_MIDDLEWARE = true;

    public static function getConfig()
    {
        return array(
            'displayErrorDetails' => self::DISPLAY_ERROR_DETAILS,
            'determineRouteBeforeAppMiddleware' => self::DETERMINE_ROUTE_BEFORE_APP_MIDDLEWARE
        );
    }
}