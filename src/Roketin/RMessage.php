<?php

namespace Roketin;

class RMessage extends Roketin
{
    public function __construct()
    {
        parent::__construct();

        $this->endPoint = '/message/api/v1/messages';
    }

    /**
     * @param $sender_name
     * @param $sender_email
     * @param $sender_phone
     * @param $message_title
     * @param $message_body
     * @param $bcc
     * @return mixed
     */
    public function send($name, $email, $phone, $title, $body, $bcc = null)
    {
        return $this->callAPI('', compact('name', 'email', 'phone', 'title', 'body', 'bcc'), "POST");
    }

    public function list()
    {
        $this->routes = '?';

        return $this;
    }

    public function table()
    {
        $this->routes = '/table?';

        return $this;
    }

    public function show($id = null)
    {
        $this->routes = '/'.$id.'?';

        return $this;
    }
}
