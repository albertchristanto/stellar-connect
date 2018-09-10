<?php

namespace Roketin;

class RDistrict extends Roketin
{
    public function __construct()
    {
        parent::__construct();

        $this->endPoint = '/location/api/v2/districts';
        
    }

    public function list($city_code = null)
    {
        $this->routes = '?';

        if (!is_null($city_code)) {
            $this->routes = '?city_code='.$city_code.'&';
        }

        return $this;
    }

    public function show($id)
    {
        $this->routes = '/'.$id.'/show?';

        return $this;
    }

}
