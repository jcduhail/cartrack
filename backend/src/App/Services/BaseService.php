<?php

namespace App\Services;

class BaseService
{
    protected $db;

    public function __construct($app)
    {
        $this->db = $app['db'];
    }

}
