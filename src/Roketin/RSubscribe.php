<?php

namespace Roketin;

class RSubscribe extends Roketin
{
    public function __construct()
    {
        parent::__construct();

        $this->endPoint = '/marketing/api/v1/subscribes';
    }

    public function list()
    {
        $this->routes = '?';

        return $this;
    }

    public function send($email)
    {
        return $this->callAPI('', compact('email'), "POST");
    }
}
