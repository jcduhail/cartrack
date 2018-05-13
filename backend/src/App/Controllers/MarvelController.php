<?php

namespace App\Controllers;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class MarvelController
{

    protected $marvelService;

    public function __construct($service)
    {
        $this->marvelService = $service;
    }

    public function getAll()
    {
        return new JsonResponse($this->marvelService->getAll());
    }

}
