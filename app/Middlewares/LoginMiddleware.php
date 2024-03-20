<?php

namespace App\Middlewares;

use ITColima\SiitecApi\SiitecApi;
use Psr\Http\Message\ResponseInterface as IResponse;
use Psr\Http\Message\ServerRequestInterface as IServerRequest;
use Psr\Http\Server\RequestHandlerInterface as IRequestHandler;

use function Francerz\Http\Utils\siteUrl;

class LoginMiddleware extends AbstractMiddleware
{
    public function process(IServerRequest $request, IRequestHandler $handler): IResponse
    {
        $siitecApi = new SiitecApi();
        if (!$siitecApi->isLoggedIn()) {
            return $siitecApi->redirectTo($siitecApi->redirectAuthUri(siteUrl('oauth2')));
        }
        return $handler->handle($request);
    }
}
