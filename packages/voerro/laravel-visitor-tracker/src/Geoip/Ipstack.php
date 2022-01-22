<?php

namespace Voerro\Laravel\VisitorTracker\Geoip;

class Ipstack extends Driver
{
    protected function getEndpoint($ip)
    {
        $key = config('visitortracker.ipstack_key');

        return "http://api.ipstack.com/{$ip}?access_key={$key}";
    }

    public function latitude()
    {
        if (isset($this->data->latitude)) {
            return $this->data->latitude;
        }
        return null;
    }

    public function longitude()
    {
        if (isset($this->data->longitude)) {
            return $this->data->longitude;
        }
        return null;
    }

    public function country()
    {

        if (isset($this->data->country_name)) {
            return $this->data->country_name;
        }
        return null;
    }

    public function countryCode()
    {

        if (isset($this->data->country_code)) {
            return $this->data->country_code;
        }
        return null;
    }

    public function city()
    {

        if (isset($this->data->city)) {
            return $this->data->city;
        }
        return null;
    }
}
