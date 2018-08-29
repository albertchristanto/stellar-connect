<?php

namespace Roketin;

class RAuth extends Roketin
{
    public function __construct()
    {
        parent::__construct();

        $this->endPoint = '/auth/api/v2/auth';
        
    }

    /**
     * Login User.
     *
     * @param $params
     * @return mixed
     */
    public function login($params)
    {   
        $this->routes = '/login';

        return $this->callAPI($this->routes, $params, "POST");
    }

    /**
     * Register User.
     *
     * @param $params
     * @return mixed
     */
    public function register($params)
    {   
        $this->routes = '/register';

        return $this->callAPI($this->routes, $params, "POST");
    }

    /**
     * Forgot User.
     *
     * @param $email
     * @return mixed
     */
    public function forgot($email)
    {   
        $this->endPoint = '/auth/api/forgot/password';

        return $this->callAPI($this->routes, compact('email'), "POST");
    }

    /**
     * Resend Activation User.
     *
     * @param $params
     * @return mixed
     */
    public function resendActivation($email)
    {   
        $this->endPoint = '/activated/user';

        return $this->callAPI($this->routes, compact('email'), "POST");
    }

}
