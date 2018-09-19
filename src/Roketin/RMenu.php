<?php

namespace Roketin;

class RMenu extends Roketin
{
    public function __construct()
    {
        parent::__construct();

        $this->endPoint = '/website/api/v1/menus';
    }

    public function list($parent_id = null)
    {
        if (is_null($parent_id)) {
            $this->routes = '?parent=null&';
        } else {
            $this->routes = '?parent='.$parent_id.'&';
        }

        return $this;
    }

    public function show($id = null)
    {
        $this->routes = '/'.$id.'?';

        return $this;
    }
}
