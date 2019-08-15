<?php

namespace Roketin;

class RMember extends Roketin {
    public function __construct() {
        parent::__construct();

        $this->endPoint = '/relation/api/v1';
    }

    public function show($id = null) {
        if (!isset($id) && isset($this->member_id)) {
            $id = $this->member_id;
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

        $this->routes = '/member/'.$id.'/show?';

        return $this;
    }

    /**
     * Member - Register
     * 
     * register() will return a RMember class which you can use to futher manipulate member
     * register() will throw \Exception if something went wrong (Eg:email already used) 
     * @return RMember
     */
    public function register($params, $send_mail_verification = false) {
        $this->routes = '/auth/register';

        $params['send_mail_verification'] = $send_mail_verification;

        $result = $this->callAPI($this->routes, $params, "POST");
    
        if (!isset($result->meta->status_code) || $result->meta->status_code != 200) {
            throw new \Exception(json_encode($result));
        }
        
        return $this->login(
            [
                'email' => $params['email'],
                'password' => $params['password']
            ]
        );
    }

    /**
     * Member - ResendEmailConfirmation
     * 
     * ResendEmainConfirmation will ask stellar to resend email confirmation
     * @return Response
     */
    public function resendEmail($id = null) {
        if (!isset($id) && isset($this->member_id)) {
            $id = $this->member_id;
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

        $this->routes = '/auth/resend-email/'.$id;

        return $this->callAPI($this->routes, [], 'POST');
    }

    /**
     * Member - HandleEmailConfirmation
     * 
     * HandleEmailConfirmation is used to manualy handle email confirmation (by ecomerce)
     * @return Response
     */
    public function handleEmailConfirmation($id, $token) {
        $this->endPoint = '/relation/activate-member/'.$id.'/'.$token;
        $this->routes = '?on-api=true';

        return $this->callAPI($this->routes);
    }

    /*
     * Member - Login
     * 
     * Login() will return a RMember class which you can use to manipulate member
     * login() will throw \Exception if something went wrong (Eg:wrong credential)
     * @return RMember
     */
    public function login($params) {
        $this->routes = '/auth/login';

        $result = $this->callAPI($this->routes, $params, "POST");
        if (!isset($result->meta->status_code) || $result->meta->status_code != 200) {
            throw new \Exception(json_encode($result));
        }
        $this->member_token = $result->data->token;
        $this->member_id = $result->data->id;

        session(['member_token' => $this->member_token]);
        session(['member_id' => $this->member_id]);

        return $this; 
    }

    /*
     * Member - getSession
     * 
     * getSession() is used to get RMember class of client's current session
     * getSession() will return a RMember class which you can use to manipulate member
     * login() will throw \Exception if something went wrong (Eg:user haven't login yet)
     * @return RMember
     */
    public function getSession() {
        if (session()->has('member_token') && session()->has('member_id')) {
            $this->member_token = session('member_token');
            $this->member_id = session('member_id');
        } else {
            throw new \Exception(json_encode(['meta' => ['status_code' => 403, 'message' => 'user has not log-ed in yet']]));            
        }

        return $this;
    }
    
    /*
     * Member - logout
     * 
     * logout() is used to delete the curent session data
     * member have to login again
     * @return response
     */
    public function logout() {
        session()->forget(['member_token', 'member_id']);

        return ['meta' => ['status_code' => 200, 'message' => 'success']];
    }

    /*
     * Member - Login
     * 
     * update() will throw \Exception if something went wrong (Eg:wrong field)
     * @return void
     */
    public function update($params, $id = null) {
        if (isset($id)) {
            $this->routes = '/member/'.$id;
            
            $result = $this->callAPI($this->routes, $params, "POST");
        } else {
            $this->routes = '/auth/update';

            $result = $this->callAPI($this->routes, $params, "POST");
        }
        if (!isset($result->meta->status_code) || $result->meta->status_code != 200) {
            throw new \Exception(json_encode($result));
        }
    }

    /*
     * Member - Change Password
     * 
     * changePassword() will throw \Exception if something went wrong (Eg:wrong field)
     * @return void
     */
    public function changePassword($params) {
        $this->routes = '/auth/change-password';

        $result = $this->callAPI($this->routes, $params, "POST");
    
        if (!isset($result->meta->status_code) || $result->meta->status_code != 200) {
            throw new \Exception(json_encode($result));
        }

        return $result;
    }

    /**
     * Member - Forgot Password
     * 
     * forgotPassword() will return member_id and a token to be used in handle forgot_password
     * if you want stellar to automagically send email and handle forgot password for you, set $send_email to true
     * forgotPassword() will throw \Exception if something went wrong (Eg: invalid email)
     */
    public function forgotPassword($email, $send_email = 'false') {
        $this->routes = '/auth/forgot-password';

        if ($send_email == true) {
            $send_email = 'true';
        }

        $params['email'] = $email;
        $params['send_mail'] = $send_email;

        $result = $this->callAPI($this->routes, $params, "POST");

        if (!isset($result->meta->status_code) || $result->meta->status_code != 200) {
            throw new \Exception(json_encode($result));
        }

        return $result;
    }

    /*
     * Member - Handle Forgot Password
     * 
     * changePassword() will throw \Exception if something went wrong (Eg:failed password confirmation)
     * @return void
     */
    public function handleForgotPassword($params, $id, $token) {
        $this->routes = '/auth/forgot-password/'.$id.'/'.$token;
        $params['on_api'] = 'true';

        $result = $this->callAPI($this->routes, $params, "POST");
        
        if (!isset($result->meta->status_code) || $result->meta->status_code != 200) {
            throw new \Exception(json_encode($result));
        }

        return $result;
    }
}
