# MetroVlcSchedule
A public API for consulting MetroValencia schedule

__Note about data:__

This project takes the data from the MetroValencia official site: [http://www.metrovalencia.es](MetroValencia) so is subject
to its modifications and probably if the API is down it would not be my fault.

### Usage

#### Resource URL

_https://metrovlcschedule.herokuapp.com/api/v1/stations_

#### Resource Information


|URL|Description|Response format|Parameters|
|------------|-----------|:----------:|----------|
|GET /api/v1/stations|Obtains all stations available with ```station_code: station_name``` format|JSON|
|GET /api/v1/stations/converter/{station_code}


