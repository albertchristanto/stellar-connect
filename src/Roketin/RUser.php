<?php

namespace Roketin;

class RUser extends Roketin
{
    public function __construct()
    {
        parent::__construct();

        $this->endPoint = '/auth/api/v2/users';
        
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

    /**
     * Show User.
     *
     * @param $params
     * @return mixed
     */
    public function show($id)
    {   
        $this->routes = '/'.$id.'?';

        return $this->callAPI($this->routes, [], "POST");
    }

    /**
     * Forgot User.
     *
     * @param $email
     * @return mixed
     */
    public function changePassword($id, $params)
    {
        $this->routes = '/'.$id.'/account?';

        return $this->callAPI($this->routes, $params, "POST");
    }

}
