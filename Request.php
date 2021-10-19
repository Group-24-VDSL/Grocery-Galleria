<?php

namespace app\core;

define('basedir',dirname(__DIR__));
define('publicdir',basedir.'/public');

class Request
{
    public function getPath(){
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path,'?'); //check the position of GET attributes
        if($position === false){
            return filter_var($path,FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        }
        return substr(filter_var($path,FILTER_SANITIZE_FULL_SPECIAL_CHARS),0,$position);

    }
    public function method(): string
    {
        return strtolower(filter_var($_SERVER['REQUEST_METHOD'],FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    }

    public function isGet(): bool
    {
        return $this->method()==='get';
    }
    public function isPost(){
        return $this->method()==='post';
    }

    public function isSet($key)
    {
        if ($this->method() === 'get'){
            return isset($_GET[$key]);
        }else{
            return isset($_POST[$key]);
        }
    }

    public function getBody(): array
    {
        $body = [];

        if($this->method() === 'get'){
            foreach ($_GET as $key => $value){
               $body[filter_var($key,FILTER_SANITIZE_FULL_SPECIAL_CHARS)] = filter_input(INPUT_GET,$key,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }
        if($this->method() === 'post'){
            foreach ($_POST as $key => $value){
                $body[filter_var($key,FILTER_SANITIZE_FULL_SPECIAL_CHARS)] = filter_input(INPUT_POST,$key,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }

        return $body;
    }

    public function getJson(): ?array
    {
        if($this->method() === 'post'){
            $raw =file_get_contents('php://input'); //access raw post request
            $rawbody = json_decode($raw,true); //decode it as a associative array
            if(json_last_error() === JSON_ERROR_NONE){ //valid json
                $body = [];
                foreach ($rawbody as $key => $value){
                    $body[filter_var($key,FILTER_SANITIZE_FULL_SPECIAL_CHARS)] = filter_var($value,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                }
                return $body;
            }else{
                return null;
            }

        }
        return null;
    }

    public function loadFile($path,$attribute,$filename=''): ?string
    {
      if($this->method() === 'post'){
          $file = getimagesize($_FILES[$attribute]["tmp_name"]);
          if($file){
              if($filename !== ''){
                  $target = $path.$filename.".".strtolower(pathinfo(basename(filter_var($_FILES[$attribute]["name"], FILTER_SANITIZE_SPECIAL_CHARS)), PATHINFO_EXTENSION));
                  if (!file_exists($target)) {
                      if ($_FILES[$attribute]["size"] < 1000000) { //1MB
                          if (in_array(strtolower(pathinfo(basename(filter_var($_FILES[$attribute]["name"], FILTER_SANITIZE_SPECIAL_CHARS)), PATHINFO_EXTENSION)), ["png", "jpg"])) {
                              if (move_uploaded_file($_FILES[$attribute]["tmp_name"], publicdir.$target)) {
                                  return $target;
                              }
                          }
                      }
                  }
              }else {
                  $target = basedir.$path . basename(filter_var($_FILES[$attribute]["name"], FILTER_SANITIZE_SPECIAL_CHARS));
                  if (!file_exists($target)) {
                      if ($_FILES[$attribute]["size"] < 500000) { //0.5MB
                          if (in_array(strtolower(pathinfo($target, PATHINFO_EXTENSION)), ["png", "jpg"])) {
                              if (move_uploaded_file($_FILES[$attribute]["tmp_name"], $target)) {
                                  return $target;
                              }else{
                                  return null;
                              }
                          }
                      }
                  }
              }
          }
      }
      return null;
    }
}