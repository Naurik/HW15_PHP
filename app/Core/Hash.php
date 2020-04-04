<?php


namespace Step\Core;


final class Hash
{

    static function make($str) {
        return password_hash($str, PASSWORD_DEFAULT);
    }

    static function check($str, $hash) {
        return password_verify($str, $hash);
    }

}
