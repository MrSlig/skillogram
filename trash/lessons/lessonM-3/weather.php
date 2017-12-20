<?php

/*
 * Получать погоду по названию города или по координатам с помощью openweather api:
 *
 * 1. Сделать запрос с нужными параметрами
 * 2. Получть ответ
 * 3. Вывести результат: иконка погоды + температура
 *
 */

require_once __DIR__ . '/MyWeather.php';

$city   = 'Saint Petersburg,ru';
$lon    = -0.13; // Moscow
$lat    = 51.51; // Moscow

$api_key = '012e34537b328a78762f56bb13b7ac8c';

$weather_api = new MyWeather($api_key, MyWeather::UNITS_METRIC);

// $result = $weather_api->getWeatherByCity($city);
$result = $weather_api->getWeatherByCoord($lat, $lon);

$icon_code  = $result['weather'][0]['icon'];
$icon_url   = 'http://openweathermap.org/img/w/' . $icon_code . '.png';


echo '<img src=' . $icon_url . ' />';
echo "temperature: " . $result['main']['temp'];

// var_dump($result);