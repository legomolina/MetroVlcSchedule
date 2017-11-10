<div class="doc-menu">
    <ul>
        <li><a href="getting-started">Getting started</a></li>
        <li><a href="stations">Stations</a></li>
        <li><a href="routes">Routes</a></li>
    </ul>
</div>

## Routes

<span id="routes"></span>

### GET api/v1/routes
Returs a schedule between two stations.

#### Resource URL

https://metrovlcschedule.herokuapp.com/api/v1/routes

#### Resource information

Response format | JSON
Requires authentication | No

#### Parameters

|Name|Required|Description|Default Value|Example|
|:---:|:------:|-----------|-------------|:-----:|
|from|required|Specifies the origin station code.| |121|
|to|required|Specifies the destination station code.| |88|
|date|optional|Specifies the date you want to perform the search with dd/mm/yyyy format.|Today|19/10/2017|
|ihour|optional|Specifies the initial time you want to perform the search with hh:mm format.|00:00|16:04|
|fhour|optional|Specifies the final time you want to perform the search with hh:mm format.|23:59|08:13|

#### Example request

GET https://metrovlcschedule.herokuapp.com/api/v1/route?from=121&to=88&date=10/11/2017&hinit=12:00&hfinal=20:05

#### Example response

```json
{
  "route_id":0,
  "from_station":121,
  "to_station":88,
  "date":"10\/11\/2017",
  "init_hour":"12:00",
  "final_hour":"20:05",
  "duration":40,
  "zone_tickets":["A","B","C","D"],
  "journey":[
    {
      "journey_id":0,
      "journey_trains":["Rafelbunyol","Machado"],
      "journey_from_station":121,
      "journey_to_station":12,
      "journey_hours":["05:27","05:57","06:27","06:57","07:12","07:27","07:42","07:57","08:12","08:27","08:42","08:57","09:12","09:27","09:42","09:57","10:12","10:27","10:42","10:57","11:12","11:27","11:42","11:57","12:12","12:27","12:42","12:57","13:12","13:27","13:42","13:57","14:12","14:27","14:42","14:57","15:12","15:27","15:42","15:57","16:12","16:27","16:42","16:57","17:12","17:27","17:42","17:57","18:12","18:27","18:42","18:57","19:12","19:27","19:42","19:57","20:12","20:27","20:42","20:57","21:12","21:32","21:42","21:51","22:02","22:12","22:21","22:32","22:51","22:57","23:27","23:57"]
    },
    {
      "journey_id":1,
      "journeyTrains":["Serrer\u00eda","Tarongers","Dr. Lluch","Mar\u00edtim - Serrer\u00eda"],
      "journey_from_station":12,
      "journey_to_station":88,
      "journey_hours":["05:27","05:57","06:27","06:57","07:12","07:27","07:42","07:57","08:12","08:27","08:42","08:57","09:12","09:27","09:42","09:57","10:12","10:27","10:42","10:57","11:12","11:27","11:42","11:57","12:12","12:27","12:42","12:57","13:12","13:27","13:42","13:57","14:12","14:27","14:42","14:57","15:12","15:27","15:42","15:57","16:12","16:27","16:42","16:57","17:12","17:27","17:42","17:57","18:12","18:27","18:42","18:57","19:12","19:27","19:42","19:57","20:12","20:27","20:42","20:57","21:12","21:32","21:42","21:51","22:02","22:12","22:21","22:32","22:51","22:57","23:27","23:57"]
    }
  ]
}
```