<?php


namespace Step;


use ActiveRecord\Config;
use Klein\Klein;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;
use const E_ALL;
use const E_NOTICE;

class App
{

    public function __construct()
    {
        $this->initErrorHandler();
        $this->initActiveRecord();
        $this->mapRoutes();
    }

    protected function mapRoutes() {
        $router = new Klein();
        include_once config('app.routes_path');
        $router->dispatch();
    }

    protected function initErrorHandler() {

        $debug = config('app.debug') === true;
        ini_set('error_reporting', intval($debug));
        error_reporting((E_ALL ^ E_NOTICE) * $debug);

        if ($debug) {
            $whoops = new Run();
            $whoops->pushHandler(new PrettyPageHandler());
            $whoops->register();
        }

    }

    protected function initActiveRecord() {
        Config::initialize(function (Config $cfg) {
            $cfg->set_model_directory( path('app/Models') );
            $cfg->set_connections( config('database.connections') );
            $cfg->set_default_connection( config('database.default') );
        });
    }

}
