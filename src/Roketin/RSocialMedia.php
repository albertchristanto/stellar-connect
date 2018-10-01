<?php

namespace Roketin;

class RSocialMedia extends Roketin
{
    public function __construct()
    {
        parent::__construct();

        $this->endPoint = '/config/api/v1/company-social-medias';
        
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

}
