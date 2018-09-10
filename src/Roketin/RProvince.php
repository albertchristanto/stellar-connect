<?php

namespace Roketin;

class RProvince extends Roketin
{
    public function __construct()
    {
        parent::__construct();

        $this->endPoint = '/location/api/v2/provinces';
        
    }

    public function list($country_code = null)
    {
        $this->routes = '?';

        if (!is_null($country_code)) {
            $this->routes = '?country_code='.$country_code.'&';
        }

        return $this;
    }

    public function show($id)
    {
        $this->routes = '/'.$id.'/show?';

        return $this;
    }

}
