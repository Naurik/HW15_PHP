<?php


namespace Step\Controllers;


use Klein\Request;
use Klein\Response;
use Step\Core\Auth;

class LoginController
{

    function form() {
        return view('auth.login');
    }

    function make(Request $request, Response $response) {
        $username = $request->param('username');
        $password = $request->param('password');

        if (Auth::login($username, $password))
            return $response->redirect('/');

        return view('auth.login', [
            'username' => $username
        ]);
    }

    function logout(Request $request, Response $response) {

        if (Auth::logout())
            return $response->redirect('/');

        return $response->code(500);
    }

}
