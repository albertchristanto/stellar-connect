<?php

namespace Roketin;

class RCountry extends Roketin
{
    public function __construct()
    {
        parent::__construct();

        $this->endPoint = '/location/api/v2/countries';
        
    }

    public function list()
    {
        $this->routes = '?';

        return $this;
    }

    public function show($id)
    {
        $this->routes = '/'.$id.'/show?';

        return $this;
    }

}
