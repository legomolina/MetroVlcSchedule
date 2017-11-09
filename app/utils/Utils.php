<?php 

namespace app\utils;

class Utils {

	/**
     * Prints server Uri located in BASE_URL constant
     */

	public static function getServerUri() {
		echo (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
	}

	/**
     * Returns server Uri located in BASE_URL constant
     */

	public static function returnServerUri() {
		return (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
	}
}