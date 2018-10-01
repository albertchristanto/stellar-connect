<?php

namespace Roketin;

class RCompany extends Roketin
{
    public function __construct()
    {
        parent::__construct();

        $this->endPoint = '/auth/api/v2/companies';
        
    }

    public function detail()
    {
        $this->routes = '/show?';

        return $this;
    }

}
