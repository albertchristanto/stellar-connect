<?php

namespace Roketin;

class RCIty extends Roketin
{
    public function __construct()
    {
        parent::__construct();

        $this->endPoint = '/location/api/v2/cities';
        
    }

    public function list($province_code = null)
    {
        $this->routes = '?';

        if (!is_null($province_code)) {
            $this->routes = 'province_code='.$province_code.'&';
        }

        return $this;
    }

    public function show($id)
    {
        $this->routes = '/'.$id.'/show?';

        return $this;
    }

}
