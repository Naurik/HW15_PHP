<?php

/**
 * ----------
 * WEB ROUTES
 * ----------
 * @var Klein $router
 */

use Klein\Klein;
use Klein\Response;
use Step\Core\Auth;

$router->get('/', function () {
    return action('Site@index');
});

//region Auth routes
$router->with('/login', function () use ($router) {

    $router->get('/?', function () {
        return action('Login@form');
    });

    $router->post('/?', function ($req, $res) {
        return action('Login@make', $req, $res);
    });

});

$router->get('/logout', function ($req, $res) {
    return action('Login@logout', $req, $res);
});
//endregion

//region Book CRUD routes
$router->with('/books', function () use ($router) {

    // Просмотр всех записей
    $router->get('/?', function () {
        return action('Book@index');
    });
    // Показывать форму
    $router->get('/create', function ($req, $res) {
        return action('Book@create', $req, $res);
    });
    // Фактическое добавление в базу
    $router->post('/create', function ($req, $res) {
        return action('Book@store', $req, $res);
    });
    // Показывать форму
    $router->get('/update/[i:id]', function ($req, $res) {
        return action('Book@update', $req, $res);
    });
    // Фактическое изменение записии в базе
    $router->post('/update/[i:id]', function ($req, $res) {
        return action('Book@edit', $req, $res);
    });
    // Удаление из базы
    $router->post('/delete/[i:id]', function ($req, $res) {
        return action('Book@delete', $req, $res);
    });
    // Просмотр единичной записи
    $router->get('/[i:id]', function ($req, $res) {
        return action('Book@show', $req, $res);
    });

});
//endregion

//region User CRUD routes
$router->with('/users', function () use ($router) {

    $router->get('/?', function ($req, $res) {
        return action('User@index', $req, $res);
    });

    $router->get('/[i:id]/?', function ($req, $res) {
        return action('User@show', $req, $res);
    });

    $router->with('/create', function () use ($router) {

        $router->get('/?', function ($req, $res) {
            return action('User@create', $req, $res);
        });
        $router->post('/?', function ($req, $res) {
            return action('User@store', $req, $res);
        });

    });

    $router->with('/update/[i:id]', function () use ($router) {

        $router->get('/?', function ($req, $res) {
            return action('User@update', $req, $res);
        });
        $router->post('/?', function ($req, $res) {
            return action('User@edit', $req, $res);
        });

    });

    $router->post('/password/[i:id]/?', function ($req, $res) {
        return action('User@password', $req, $res);
    });

    $router->post('/delete/[i:id]/?', function ($req, $res) {
        return action('User@delete', $req, $res);
    });

    $router->post('/toggle/[i:id]/?', function ($req, $res) {
        return action('User@toggleAdmin', $req, $res);
    });

});
//endregion

$router->with('/profile', function () use ($router) {
    $router->respond('GET', '*', function ($req, Response $response) {
        if (!Auth::check()) {
            $response->code(403)->send();
        }
    });

    $router->get('/?', function ($req, $res) {
        return action('Profile@index', $req, $res);
    });

    $router->post('/password/?', function($req, $res) {
        return action('Profile@password', $req, $res);
    });

    $router->post('/avatar/?', function ($req, $res) {
        return action('Profile@avatar', $req, $res);
    });

});

$router->get('/avatar/[i:id]/?', function ($req, $res) {
    return action('User@avatar', $req, $res);
});
