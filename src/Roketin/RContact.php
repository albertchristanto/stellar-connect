<?php

namespace Roketin;

class RContact extends Roketin {
    public function __construct($member_id, $member_token) {
        parent::__construct();
        $this->member_id = $member_id;
        $this->member_token = $member_token;

        $this->endPoint = '/relation/api/v1/contact';
    }

    public function list() {
        $this->routes = '?';

        return $this;
    }

    public function show($id = null) {
        $this->routes = '/'.$id.'/show?';

        return $this;
    }
    
    public function store($params, $member_id = null) {
        $this->routes = '';
        if (isset($member_id)) {
            $params['member_id'] = $member_id;
        } else if(isset($this->member_id)) {
            $params['member_id'] = $this->member_id;
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

        $result = $this->callAPI($this->routes, $params, "POST");

        return $result;
    }

    public function update($params, $address_id) {
        $this->routes = '/'.$address_id;

        $result = $this->callAPI($this->routes, $params, "POST");

        return $result;
    }

    public function destroy($address_id) {
        $this->routes = '/'.$address_id.'/destroy';

        $result = $this->callAPI($this->routes, [], "POST");

        return $result;
    }
}
