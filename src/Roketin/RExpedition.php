<?php

namespace Roketin;

class RExpedition extends Roketin
{
    public function __construct()
    {
        parent::__construct();

        $this->endPoint = '/order/api/v1/company-expeditions';
        
    }

    public function list()
    {
        $this->routes = '?';

        return $this;
    }

    public function show($id)
    {
        $this->routes = '/'.$id.'?';

        return $this;
    }

    public function cost($params)
    {
        $this->routes = '/cost?';

        return $this->callAPI($this->routes, $params, "POST");
    }
}
