<div class="doc-menu">
    <ul>
        <li><a href="documentation/getting-started">Getting started</a></li>
        <li><a href="documentation/stations">Stations</a></li>
        <li><a href="documentation/routes">Routes</a></li>
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
|hinit|optional|Specifies the initial time you want to perform the search with hh:mm format.|00:00|16:04|
|hfinal|optional|Specifies the final time you want to perform the search with hh:mm format.|23:00|08:13|

#### Example request

GET https://metrovlcschedule.herokuapp.com/api/v1/route?from=121&to=88&date=10/11/2017&hinit=12:00&hfinal=20:05

#### Example response

```json
{
  
}
```