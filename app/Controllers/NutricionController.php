<?php

namespace App\Controllers;

use App\Application;
use Psr\Http\Message\ResponseInterface as IResponse;
use Psr\Http\Message\ServerRequestInterface as IServerRequest;

class NutricionController extends AbstractController
{
    public function indexGet(IServerRequest $request, IResponse $response, array $params): IResponse
    {
        return $response;
    }

    public function agregarGet(IServerRequest $request, IResponse $response, array $params): IResponse
    {
        return Application::getRenderer()->render();
    }

    public function agregarPost(IServerRequest $request, IResponse $response, array $params): IResponse
    {
        return Application::getRenderer()->renderRedirect();
    }

    public function eliminarPost(IServerRequest $request, IResponse $response, array $params): IResponse
    {
        return Application::getRenderer()->renderRedirect();
    }

    public function filtrarGet(IServerRequest $request, IResponse $response, array $params): IResponse
    {
        return Application::getRenderer()->render();
    }

    public function filtrarPost(IServerRequest $request, IResponse $response, array $params): IResponse
    {
        return Application::getRenderer()->renderRedirect();
    }

    public function itemGet(IServerRequest $request, IResponse $response, array $params): IResponse
    {
        return Application::getRenderer()->render();
    }

    public function modificarPost(IServerRequest $request, IResponse $response, array $params): IResponse
    {
        return Application::getRenderer()->renderRedirect();
    }

    public function modifcarGet(IServerRequest $request, IResponse $response, array $params): IResponse
    {
        return Application::getRenderer()->render();
    }

}
