<div class="doc-menu">
    <ul>
        <li><a href="getting-started">Getting started</a></li>
        <li><a href="stations">Stations</a></li>
        <li><a href="routes">Routes</a></li>
    </ul>
</div>

### Getting started

This section has several examples to show how to use the API.

#### Php

In this example you can view how to get the station code from name:

```php
<?php

//Obtain the station name
$originStationName = $_POST["origin_station"];

$curl = curl_init("https://metrovlcschedule.herokuapp.com/api/v1/stations/converter/$originStationName");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

//Use this if your domain is not secure
//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$curlResponse = curl_exec($curl);
curl_close($curl);

//Get as assoc array
$station = json_decode($curlResponse, true);

//$station["station_code"];
//$station["station_name"];

```

With the station code you can make a route.

```php
<?php

//Obtain the station name
$query = http_build_query([
    "from" => $station1["station_code"],
    "to" => $station2["station_code"],
    "date" => date("d/m/Y")
]);

$curl = curl_init("https://metrovlcschedule.herokuapp.com/api/v1/routes?$query");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

//Use this if your domain is not secure
//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$curlResponse = curl_exec($curl);
curl_close($curl);

//Get as assoc array
$route = json_decode($curlResponse, true);
```

In route you'll get an associative array as it's shown in [Routes](documentation/routes#routes).