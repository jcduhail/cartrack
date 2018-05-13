<?php

namespace App\Controllers;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class UsersController
{

    protected $usersService;

    public function __construct($service)
    {
        $this->usersService = $service;
    }

    public function getOne($id)
    {
        return new JsonResponse($this->usersService->getOne($id));
    }

    public function getAll()
    {
        return new JsonResponse($this->usersService->getAll());
    }

    public function save(Request $request)
    {

        $user = $this->getDataFromRequest($request);
        return new JsonResponse(array("id" => $this->usersService->save($user)));
    }

    public function update($id, Request $request)
    {
        $user = $this->getDataFromRequest($request);
        $this->usersService->update($id, $user);
        return new JsonResponse($user);
    }

    public function delete($id)
    {
        return new JsonResponse($this->usersService->delete($id));
    }
    
    public function login(Request $request){
      return $this->usersService->login($request);
    }
    
    public function signup(Request $request){
        return new JsonResponse(true);
        return $this->usersService->signup($request);
    }
    
    

    public function getDataFromRequest(Request $request)
    {
        return $user = array(
            "user" => $request->request->get("user")
        );
    }
}
