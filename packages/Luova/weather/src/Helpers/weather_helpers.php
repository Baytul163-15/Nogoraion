<?php

if (!function_exists('lv_weather')) {
    function lv_weather()
    {

        $result = ' <div class="sidebar-title section-title"><h2> আবহাওয়া </h2> </div>';
        $result .= '<ul class="weather_widget">';


        foreach (config('weather.citys') as $key =>  $item) {

            $html = lvWeatherCall($item);
            // dd($html);
            if ($html && isset($html['cod']) && $html['cod'] == 200) {

                $temp = $html['main']['temp'];
                $image = $html['weather'][0]['icon'];
                $imagelink = 'http://openweathermap.org/img/wn/' . $image . '.png';
                $result .= '<li> <img src="' . $imagelink . '" alt=""><span class="name">' . $key . '</span> <span class="unit">' . $temp . '°C</span>  </li>';
            }
        }


        $result .= '</ul>';


        return $result;
    }
}
if (!function_exists('lvWeatherCall')) {
    function lvWeatherCall($city)
    {

        $api_key = config('weather.setting.api_key');
        $units = config('weather.setting.units');
        $city = $city;
        if ($city['city']) {
            $url = 'http://api.openweathermap.org/data/2.5/weather?q=' . $city['city'] . '&units=' . $units . '&APPID=' . $api_key;
        } else {
            $url = 'http://api.openweathermap.org/data/2.5/weather?lat=' . $city['lat'] . '&lon=' . $city['lon'] . '&units=' . $units . '&APPID=' . $api_key;
        }


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $data = curl_exec($ch);
        //dd($data);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        //$data = 'working';

        return json_decode($data, true);
    }
}
if (!function_exists('lvWeatherCallDev')) {
    function lvWeatherCallDev($city)
    {

        $api_key = config('weather.setting.api_key');
        $units = config('weather.setting.units');
        $city = $city;
        if ($city['city']) {
            $url = 'http://api.openweathermap.org/data/2.5/weather?q=' . $city['city'] . '&units=' . $units . '&APPID=' . $api_key;
        } else {
            $url = 'http://api.openweathermap.org/data/2.5/forecast?lat=' . $city['lat'] . '&lon=' . $city['lon'] . '&units=' . $units . '&APPID=' . $api_key;
        }


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $data = curl_exec($ch);
        //dd($data);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        //$data = 'working';

        return json_decode($data, true);
    }
}
