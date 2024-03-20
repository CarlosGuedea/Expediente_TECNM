<?php


namespace App\Controllers;

use App\Application;
use Psr\Http\Message\ResponseInterface as IResponse;
use Psr\Http\Message\ServerRequestInterface as IServerRequest;

class GeneralController extends AbstractController
{
    public function indexGet(IServerRequest $request, IResponse $response, array $params): IResponse
    {
        return $response;
    }

    public function filtrarGet(IServerRequest $request, IResponse $response, array $params): IResponse
    {
        return Application::getRenderer()->render();
    }
}

