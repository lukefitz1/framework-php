<?php

class Core_Model_Session {

    function __construct() {

    }

    public function getSession($name) {
        return $_SESSION[$name];
    }

    public function setSession($name, $value) {
        $_SESSION[$name] = $value;
    }

    public function deleteSession($name) {
        session_unset();
        session_destroy();
    }

}