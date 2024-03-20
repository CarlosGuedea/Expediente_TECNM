<?php

namespace App\Controllers;

use App\Application;
use App\Session;
use Psr\Http\Message\ResponseInterface as IResponse;
use Psr\Http\Message\ServerRequestInterface as IServerRequest;

class HomeController extends AbstractController
{
    public function indexGet(IServerRequest $request, IResponse $response, array $params): IResponse
    {
        $perfil = Session::getPerfil();
        return Application::getRenderer()->renderView('/home/indexGet', [
            'perfil' => $perfil
        ]);
    }
}
