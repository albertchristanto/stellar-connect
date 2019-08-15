<?php

namespace Roketin;

class RShipping extends Roketin
{

    public function __construct()
    {
        parent::__construct();
    }

    public function freeShipping() {
        $this->endPoint = '/config/api/v1/freeshipping';

        return $this;
    }

    public function show() {
        $this->routes = '/show?show_service=true';

        return $this->callAPI($this->routes);
    }
}
