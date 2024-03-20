<?php

namespace App\Controllers;

use App\Application;
use App\Models\Usuario;
use App\Session;
use Fig\Http\Message\StatusCodeInterface;
use Francerz\Http\Utils\UriHelper;
use ITColima\SiitecApi\SiitecApi;
use Psr\Http\Message\ResponseInterface as IResponse;
use Psr\Http\Message\ServerRequestInterface as IServerRequest;

use function Francerz\Http\Utils\siteUrl;

class OAuth2Controller extends AbstractController
{
    public function indexGet(IServerRequest $request, IResponse $response, array $params): IResponse
    {
        $siitecApi = new SiitecApi();

        if ($siitecApi->isLoggedIn()) {
            return $response
                ->withStatus(StatusCodeInterface::STATUS_TEMPORARY_REDIRECT)
                ->withHeader('Location', UriHelper::getSiteUrl());
        }

        $query = $request->getQueryParams();
        return $siitecApi->login(
            UriHelper::getSiteUrl('/oauth2/callback'),
            UriHelper::getSiteUrl('/logout'),
            [],
            $query['usuario'] ?? null
        );
    }

    public function callbackGet(IServerRequest $request, IResponse $response, array $params): IResponse
    {
        $siitecApi = new SiitecApi();

        $redirUri = $siitecApi->handleLogin($request);

        $perfil = $siitecApi->getPerfil();
        // Esta linea se debe descomentar una vez que tengan la tabla de usuario para que se sincronice de siitec.
       /*  Usuario::sincronizarId($perfil->usuario_id); */
        Session::setPerfil($perfil);

        return Application::getRenderer()->renderRedirect((string)$redirUri);
    }

    public function logoutGet(IServerRequest $request, IResponse $response, array $params): IResponse
    {
        $siitecApi = new SiitecApi();
        $response = $siitecApi->handleLogout();
        Session::destroy();
        return $response;
    }
}
