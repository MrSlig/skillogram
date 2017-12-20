<?php

class MyWeather
{

    const UNITS_METRIC      = 'metric',
          UNITS_IMPERIAL    = 'imperial';

    private $api_key, $units;

    public function __construct($key, $units = self::UNITS_METRIC)
    {
        $this->api_key  = $key;
        $this->units    = $units;
    }

    public function getWeatherByCity($city)
    {
        $params = [
            'q' => $city,
        ];

        return $this->getWeather($params);
    }


    public function getWeatherByCoord($lat, $lon) {
        $params = [
            'lat' => $lat,
            'lon' => $lon,
        ];

        return $this->getWeather($params);
    }


    private function getWeather($params)
    {
        $params['appid'] = $this->api_key;
        $params['units'] = $this->units;

        $params = http_build_query($params);
        $url = "http://api.openweathermap.org/data/2.5/weather?{$params}";

        // create a new cURL resource:
        $ch = curl_init();  // curl handler

        // set URL and other appropriate options:   !check documentation!
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // grab URL and pass it to the browser:
        $result = curl_exec($ch);

        // close cURL resource, and free up system resources:
        curl_close($ch);

        $result = json_decode($result, true); // check documentation

        return $result;
    }
}