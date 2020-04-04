<?php


namespace Step\Controllers;


use Klein\Request;
use Klein\Response;
use Step\Core\Auth;
use Step\Core\Hash;

class ProfileController
{

    function index() {
        return view('profile.index');
    }

    function password(Request $request, Response $response) {

        $password = $request->param('password');
        $confirm = $request->param('password_confirm');

        if ($password !== $confirm)
            return $response->json([
                'message' => 'Пароли не совпадают'
            ]);

        $user = Auth::user();
        $user->password = Hash::make($password);
        $user->save();

        return $response->json([
            'message' => 'Пароль изменился'
        ]);
    }

    function avatar(Request $request, Response $response) {
        $file = $request->files()->get('avatar');

        if (explode('/', $file['type'])[0] !== 'image')
            return 'Пес, дай картинку!';

        $imageid = md5(hexdec(uniqid()));
        $name = explode('.', $file['name']);
        $ext = array_pop($name);

        $path = "avatars/$imageid.$ext";

        move_uploaded_file($file['tmp_name'], path("resources/$path") );
        $user = Auth::user();

        if ($user->avatar !== null)
            unlink( path("resources/{$user->avatar}") );

        $user->avatar = $path;
        $user->save();

        return $response->redirect('/profile');
    }

}
