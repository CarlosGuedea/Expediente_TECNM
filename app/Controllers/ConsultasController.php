<?php

namespace App\Controllers;

use App\Application;
use App\Models\Consulta;
use Psr\Http\Message\ResponseInterface as IResponse;
use Psr\Http\Message\ServerRequestInterface as IServerRequest;

class ConsultasController extends AbstractController
{
    public function indexGet(IServerRequest $request, IResponse $response, array $params): IResponse
    {
        $consultas = Consulta::getRows();
        return Application::getRenderer()->renderView('consultas/indexGet', [
            'consultas' => $consultas
        ]);
        return Application::getRenderer()->renderJson($consultas);
        return Application::getRenderer()->renderCsv($consultas,"consultas.csv");
    }
}

