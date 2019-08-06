<?php

namespace Roketin;

class RWishlist extends Roketin
{
    public function __construct()
    {
        parent::__construct();

        $this->endPoint = '/relation/api/v1/wishlist';
    }

    public function show($id)
    {
        $this->routes = '?user_id='.$id.'&';

        return $this;
    }

    /**
     * Wishlist Add.
     *
     * @param $params
     * @return mixed
     */
    public function store($params)
    {
        $this->routes = '/create';

        return $this->callAPI($this->routes, $params, "POST");
    }

    /**
     * Wishlist Delete.
     *
     * @param $params
     * @return mixed
     */
    public function delete($params)
    {
      $this->routes = '/delete';

        return $this->callAPI($this->routes, $params, "POST");
    }
}