<?php

namespace Roketin;

class RVariant extends Roketin
{
    public function __construct()
    {
        parent::__construct();

        $this->endPoint = '/product/api/v1/variant';
    }

    public function list()
    {
        $this->routes = '?';

        return $this;
    }

    public function show($id = null)
    {
        $this->routes = '/'.$id.'/show?';

        return $this;
    }
}
