<div class="doc-menu">
    <ul>
        <li><a href="documentation/getting-started">Getting started</a></li>
        <li><a href="documentation/stations">Stations</a></li>
        <li><a href="documentation/routes">Routes</a></li>
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
[
  {
    "1" : "test"
  }
]
```