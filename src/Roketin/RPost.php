<?php

namespace Roketin;

class RPost extends Roketin
{
    public function __construct()
    {
        parent::__construct();

        $this->endPoint = '/website/api/v1/posts';
    }

    public function list()
    {
        $this->routes = '?isClient=true&';

        return $this;
    }

    public function show($id = null)
    {
        $this->routes = '/'.$id.'?isClient=true&';

        return $this;
    }
}
