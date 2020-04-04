<?php


namespace Step\Controllers;


use Klein\Request;
use Klein\Response;
use Step\Core\Auth;
use Step\Core\Hash;
use Step\Models\User;

class UserController
{

    function index(Request $request, Response $response)
    {

        if (!Auth::check() || !Auth::user()->isAdmin())
            return $response->code(403);

        return view('users.index', [
            'title' => 'Пользователи',
            'users' => User::all()
        ]);
    }

    function show(Request $request, Response $response)
    {
        if (!Auth::check() || !Auth::user()->isAdmin())
            return $response->code(403);

        $user = User::find_by_id($request->param('id'));

        if ($user === null)
            return $response->code(404);

        return view('users.show', [
            'user' => $user
        ]);
    }

    function create(Request $request, Response $response)
    {
        if (!Auth::check() || !Auth::user()->isAdmin())
            return $response->code(403);

        return view('users.create');
    }

    function store(Request $request, Response $response)
    {
        if (!Auth::check() || !Auth::user()->isAdmin())
            return $response->code(403);

        $user = new User();
        $user->username = $request->param('username');
        $user->password = Hash::make($request->param('password'));
        $user->save();
        return $response->redirect("/users/{$user->id}");
    }

    function update(Request $request, Response $response)
    {
        if (!Auth::check() || !Auth::user()->isAdmin())
            return $response->code(403);

        $user = User::find_by_id($request->param('id'));

        if ($user === null)
            return $response->code(404);

        return view('users.update', [
            'user' => $user
        ]);
    }

    // Для обычных изменений
    function edit(Request $request, Response $response)
    {
        if (!Auth::check() || !Auth::user()->isAdmin())
            return $response->code(403);

        $user = User::find_by_id($request->param('id'));

        if ($user === null)
            return $response->code(404);

        $user->username = $request->param('username');
        $user->save();

        return $response->redirect("/users/{$user->id}");
    }

    // Для изменения пароля
    function password(Request $request, Response $response)
    {
        if (!Auth::check() || !Auth::user()->isAdmin())
            return $response->code(403);

        $user = User::find_by_id($request->param('id'));

        if ($user === null)
            return $response->code(404);

        $user->password = Hash::make($request->param('password'));
        $user->save();

        return $response->redirect("/users/{$user->id}");
    }

    function delete(Request $request, Response $response)
    {
        if (!Auth::check() || !Auth::user()->isAdmin())
            return $response->code(403);

        $user = User::find_by_id($request->param('id'));

        if ($user === null)
            return $response->code(404);

        $user->delete();
        return $response->redirect('/users');
    }

    function toggleAdmin(Request $request, Response $response)
    {
        if (!Auth::check() || !Auth::user()->isAdmin())
            return $response->json([
                'code' => 403,
                'message' => 'ТЫ НЕ ПРОЙДЕШЬ!!!'
            ]);

        $user = User::find_by_id($request->param('id'));

        if ($user === null)
            return $response->json([
                'code' => 404,
                'message' => 'Нет ничего...'
            ]);

        $user->admin = intval(!boolval($user->admin));
        $user->save();

        return $response->json([
            'code' => 200,
            'message' => 'Успешно изменено'
        ]);
    }

    function avatar(Request $request, Response $response) {

        $user = User::find_by_id( $request->param('id') );

        if ($user === null)
            return $response->code(404);

        return $response->file( path("resources/{$user->avatar}") );
    }

}
