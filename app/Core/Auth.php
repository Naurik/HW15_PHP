<?php


namespace Step\Core;


use Step\Models\User;

final class Auth
{

    /**
     * @return User|null
     */
    static function user() {

        $token = Cookie::get('auth');

        if ($token === null)
            return null;

        return User::find_by_token($token);
    }

    static function check(): bool {
        return self::user() !== null;
    }

    static function login($username, $password): bool {

        if (!$username || !$password)
            return false;

        /** @var \Step\Models\User $user */
        $user = User::find_by_username($username);

        if ($user === null)
            return false;

        if (Hash::check($password, $user->password) === false)
            return false;

        $token = md5(hexdec(uniqid()));
        $user->token = $token;
        $user->save();

        $expire = time() + (7 * 24 * 60 * 60);
        Cookie::set('auth', $token, $expire);
        return true;
    }

    static function logout() {

        if (self::check() === false)
            return true;

        Cookie::set('auth', null, -1);

        $user = self::user();
        $user->token = null;
        $user->save();

        return true;
    }

}
