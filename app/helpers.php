<?php

use Klein\Request;
use Klein\Response;
use Step\Core\RenderEngine;

function action($name, Request $request = null, Response $response = null) {
    $name = explode('@', $name);
    $controller = "Step\Controllers\\" . $name[0] . "Controller";
    $action = $name[1];

    $class = new $controller();
    return call_user_func([$class, $action], $request, $response);
}

function path($path) {

    $base = getcwd();
    $base = dirname($base);

    $path = str_replace('\\', DIRECTORY_SEPARATOR , $path);
    $path = str_replace('/', DIRECTORY_SEPARATOR, $path);
    $path = trim($path, DIRECTORY_SEPARATOR);

    return $base . DIRECTORY_SEPARATOR . $path;
}

function config($name) {

    $name = explode('.', $name);
    $file = array_shift($name);
    $file = path("config/{$file}.php");

    if (!file_exists($file) or !is_file($file))
        return null;

    $res = include $file;

    foreach ($name as $key) {
        $res = $res[$key] ?? null;
    }

    return $res;
}

function view($name, array $variables = []) {

    $name = str_replace('.', DIRECTORY_SEPARATOR, $name);
    $ext = config('app.template_extension');
    $name = "{$name}.{$ext}";

    $engine = RenderEngine::instance();
    foreach ($variables as $key => $value) {
        $engine->assign($key, $value);
    }

    return $engine->fetch($name);
}

function session($key, $value = null) {

    if ($value === null) {
        return $_SESSION[$key] ?? null;
    }

    $_SESSION[$key] = $value;
    return session($key);
}
