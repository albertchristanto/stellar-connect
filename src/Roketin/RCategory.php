<?php

namespace Roketin;

class RCategory extends Roketin
{
    public function __construct()
    {
        parent::__construct();

        $this->endPoint = '/product/api/v1/category';
    }

    public function list()
    {
        $this->routes = '?parent=null&';

        return $this;
    }

    public function show($id = null)
    {
        $this->routes = '/'.$id.'/show?';

        return $this;
    }
}
