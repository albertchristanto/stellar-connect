<?php

namespace Roketin;

class RSalesOrder extends Roketin
{
    public function __construct()
    {
        parent::__construct();

        $this->endPoint = '/order/api/v1/sales-orders';
        
    }

    /**
     * Sales Order Index.
     *
     * @return mixed
     */
    public function list()
    {
        $this->routes = '?';

        return $this;
    }

    /**
     * Sales Order Detail.
     *
     * @param $id
     * @return mixed
     */
    public function show($id = null)
    {
        $this->routes = '/'.$id.'?';

        return $this;
    }

    /**
     * Sales Order Search.
     *
     * @param $query
     * @return mixed
     */
    public function search($query = null)
    {
        $this->routes = '/search?query='.$query.'&';

        return $this;
    }

    /**
     * Sales Order Store.
     *
     * @param $params
     * @return mixed
     */
    public function store($params)
    {
        $this->routes = '/ecommerce?';

        return $this->callAPI($this->routes, $params, "POST");
    }
}
