<?php

class Core_Model_Cookie {

    public function setCookie($name, $value, $time) {
        setcookie($name, $value, $time);
    }

    public function deleteCookie($name) {
        setcookie($name, "", time() - 3600);
    }

    public function getCookie($name) {
        return $_COOKIE[$name];
    }
}