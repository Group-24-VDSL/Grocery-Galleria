<?php

namespace app\core;


class Response
{
    public function statusCode(int $code)
    {
        http_response_code($code);
    }

    public function redirect(string $string)
    {
        header('Location: '.$string);
    }

    public function setContentTypeJSON(){
        header('Content-Type: application/json');
    }

    public function json($object)
    {
        $this->setContentTypeJSON();
        return json_encode($object);
    }
}