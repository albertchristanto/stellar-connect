<?php

namespace Roketin;

class RProduct extends Roketin
{
    public function __construct()
    {
        parent::__construct();

        $this->endPoint = '/product/api/v1/products';
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
