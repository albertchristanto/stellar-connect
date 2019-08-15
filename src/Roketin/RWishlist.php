<?php

namespace Roketin;

class RWishlist extends Roketin
{
    public function __construct($member_id, $member_token)
    {
        parent::__construct();

        $this->member_id = $member_id;
        $this->member_token = $member_token;

        $this->endPoint = '/relation/api/v1/wishlist';
    }

    public function list()
    {
        $this->routes = '?';

        return $this;
    }

    /**
     * Wishlist Add.
     *
     * @param $params
     * @return mixed
     */
    public function store($params, $member_id = null)
    {
        if (isset($member_id)) {
            $params['user_id'] = $member_id;
        } else if(isset($this->member_id)) {
            $params['user_id'] = $this->member_id;
        } else {
            return response()->json([
                'meta' => [
                    'status_code' => 400,
                    'message' => [
                        'member_id cant be found',
                        'you need to specify it in function parameters or using member\'s object'
                    ]
                ]
            ]);
        }

        $this->routes = '/create';

        return $this->callAPI($this->routes, $params, "POST");
    }

    /**
     * Wishlist Delete.
     *
     * @param $params
     * @return mixed
     */
    public function delete($params, $member_id = null)
    {
        $this->routes = '/delete';

        if (isset($member_id)) {
            $params['user_id'] = $member_id;
        } else if(isset($this->member_id)) {
            $params['user_id'] = $this->member_id;
        } else {
            return response()->json([
                'meta' => [
                    'status_code' => 400,
                    'message' => [
                        'member_id cant be found',
                        'you need to specify it in function parameters or using member\'s object'
                    ]
                ]
            ]);
        }

        return $this->callAPI($this->routes, $params, "POST");
    }
}