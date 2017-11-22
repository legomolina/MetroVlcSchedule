<div class="doc-menu">
    <ul>
        <li><a href="documentation/stations">Stations</a></li>
        <li><a href="documentation/routes">Routes</a></li>
    </ul>
</div>

### MetroVlc Schedule Documentation
These pages contain all you need to know about how MVS works and all URL routes.

### [Stations](documentation/stations)
There are two URL to retrieve the stations. Every station has a ```station_code``` and ```station_name``` that are unique.

[MetroValencia](http://www.metrovalencia.es) don't give this information so I've take those stations from the code and they are
hardcoded in a json list.


[GET api/v1/stations](documentation/stations#stations) returns the list in json format.

[GET api/v1/stations/converter/{station_code \| station_name}](documentation/stations#converter) returns the station object with the provided code __or__ name.

### [Routes](documentation/routes)
There are one method to get the schedule between two stations. These schedule is taken from [MetroValencia](http://www.metrovalencia.es)
so it will be up-to-date.  

[GET api/v1/routes](documentation/routes#routes) returns the schedule between two stations. Go to the page to see parameters.