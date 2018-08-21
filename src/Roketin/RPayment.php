<?php

namespace Roketin;

class RPayment extends Roketin
{
    public function __construct()
    {
        parent::__construct();

        $this->endPoint = '/order/api/v1/payments';
        
    }

    /**
     * Create Payment.
     *
     * @param $params
     * @return mixed
     */
    public function store($params)
    {   
        return $this->callAPI($this->routes, $params, "POST");
    }

    /**
     * Confirm Payment.
     *
     * @param $params
     * @return mixed
     */
    public function confirm($id)
    {
        $params = [
            'status' => 'paid'
        ];
        
        $this->routes = '/'.$id;

        return $this->callAPI($this->routes, $params, "POST");
    }
}
