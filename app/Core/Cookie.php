<?php


namespace Step\Core;


final class Cookie
{

    static function set($key, $value = "", $expire = 0, $domain = "", $secure = false, $httponly = false) {
        setcookie(md5($key), $value, $expire, '/', $domain, $secure, $httponly);
    }

    static function get($key) {
        return $_COOKIE[md5($key)] ?? null;
    }

}
