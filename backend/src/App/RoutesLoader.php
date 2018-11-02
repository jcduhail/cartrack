<?php

namespace App;

use Silex\Application;

class RoutesLoader
{
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->instantiateControllers();

    }

    private function instantiateControllers()
    {
        $this->app['users.controller'] = function() {
            return new Controllers\UsersController($this->app['users.service']);
        };
        $this->app['marvel.controller'] = function() {
            return new Controllers\MarvelController($this->app['marvel.service']);
        };
    }

    public function bindRoutesToControllers()
    {
        $api = $this->app["controllers_factory"];

        $api->get('/users', "users.controller:getAll");
        $api->get('/users/{id}', "users.controller:getOne");
        $api->post('/users', "users.controller:save");
        $api->post('/login', "users.controller:login");
        $api->put('/users/{id}', "users.controller:update");
        $api->delete('/users/{id}', "users.controller:delete");
        $api->post('/search_users', "users.controller:search");
        
        $this->app->mount($this->app["api.endpoint"].'/'.$this->app["api.version"], $api);
    }
}

