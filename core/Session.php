<?php

namespace app\core;

class Session //gets the session variables
{
    protected const FLASH_KEY = 'flash_messages';
    public function __construct(){
        session_start();
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => &$flashMessage) { //remove current flash messages //& before variable. pass by reference
            $flashMessage['remove'] = true;
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }
    public function setFlash($key, $message){
        $_SESSION[self::FLASH_KEY][$key] = [
            'remove' => false,
            'value' => $message
        ];
    }

    public function getFlash($key){
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }

    private function removeFlashMessages()
    {
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => $flashMessage) {
            if ($flashMessage['remove']) {
                unset($flashMessages[$key]);
            }
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }



    public function get($key)
    {
        return $_SESSION[$key] ?? false;
    }

    public function __destruct()
    {
        $this->removeFlashMessages();
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function remove(string $key)
    {
        unset($_SESSION[$key]);
    }

}