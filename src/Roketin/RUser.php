<?php

namespace Roketin;

class RUser extends Roketin
{
    public function __construct()
    {
        parent::__construct();

        $this->endPoint = '/api/v2/users';
        
    }

    /**
     * Register User.
     *
     * @param $params
     * @return mixed
     */
    public function register($params)
    {   
        $this->routes = '?';

        return $this->callAPI($this->routes, $params, "POST");
    }

    /**
     * Update User.
     *
     * @param $params
     * @return mixed
     */
    public function update($id, $params)
    {   
        $this->routes = '/'.$id.'?';

        return $this->callAPI($this->routes, $params, "POST");
    }

}
