<?php

namespace Roketin;

class RVoucher extends Roketin
{
    public function __construct()
    {
        parent::__construct();

        $this->endPoint = '/marketing/api/v1/vouchers/check';
        
    }

    /**
     * Check Voucher.
     *
     * @param $params
     * @return mixed
     */
    public function check($params)
    {
        return $this->callAPI($this->routes, $params, "POST");
    }
}
