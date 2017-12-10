<div class="doc-menu">
    <ul>
        <li><a href="stations">Stations</a></li>
        <li><a href="routes">Routes</a></li>
        <li><a href="card">Card</a></li>
    </ul>
</div>

## Stations

<span id="stations"></span>

### GET api/v1/stations
Returs a list with all stations available.

#### Resource URL

https://metrovlcschedule.herokuapp.com/api/v1/stations

#### Resource information

Response format | JSON
Requires authentication | No

#### Parameters

None

#### Example request

GET https://metrovlcschedule.herokuapp.com/api/v1/stations

#### Example response

```json
{
  "121":"Aeroport",
  "14":"Alameda",
  "5":"Albalat dels Sorells",
  "36":"Alberic",
  "10":"Alboraya-Palmaret"
}
```

<span id="converter"></span>

### GET api/v1/stations/converter/{station_code \| station_name}
Returs the station given by station_code or station_name.

#### Resource URL

https://metrovlcschedule.herokuapp.com/api/v1/stations/converter/{station_code \| station_name}

#### Resource information

Response format | JSON
Requires authentication | No

#### Parameters

|Name|Required|Description|Default Value|Example|
|:---:|:------:|-----------|-------------|:-----:|
|station_code|required (one of the two)|Specifies the station code you are looking for.| |5|
|station_name|required (one of the two)|Specifies the station name you are looking for.| |"Sant Joan"|

#### Example request

GET https://metrovlcschedule.herokuapp.com/api/v1/stations/converter/5  
GET https://metrovlcschedule.herokuapp.com/api/v1/stations/converter/Sant Joan

#### Example response

```json
{
  "station_code":121,
  "station_name":"Aeroport"
}
```