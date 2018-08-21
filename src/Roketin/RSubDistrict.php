<?php

namespace Roketin;

class RSubDistrict extends Roketin
{
    public function __construct()
    {
        parent::__construct();

        $this->endPoint = '/location/api/v2/subdistricts';
        
    }

    public function list($district_code)
    {
        $this->routes = '?district_code='.$district_code.'&';

        return $this;
    }

    public function show($id)
    {
        $this->routes = '/'.$id.'/show?';

        return $this;
    }

}
