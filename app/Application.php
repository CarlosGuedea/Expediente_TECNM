<?php

namespace App;

use App\Controllers\HomeController;
use App\Controllers\OAuth2Controller;
use App\Middlewares\LoginMiddleware;
use App\Middlewares\MetricsMiddleware;
use Francerz\Http\HttpFactory;
use Francerz\Http\Utils\UriHelper;
use Francerz\WebappCommons\Middlewares\DebugMiddleware;
use Francerz\WebappRenderUtils\Renderer;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Factory\AppFactory;
use Slim\App as SlimApp;
use Slim\Routing\RouteCollectorProxy;

class Application
{
    /** @var SlimApp */
    private $slimApp;

    public static function getRenderer()
    {
        static $renderer;
        if (!isset($renderer)) {
            $httpFactory = new HttpFactory();
            $renderer = new Renderer($httpFactory, $httpFactory);
            $renderer->setViewsBasePath(dirname(__FILE__, 2) . '/res/views');
        }
        return $renderer;
    }

    public function __construct()
    {
        $siteUrl = UriHelper::getSiteUrl();
        $httpManager = HttpFactory::getManager();
        $siteUri = $httpManager->getUriFactory()->createUri($siteUrl);
        $sitePath = $siteUri->getPath();

        $this->slimApp = $slimApp = AppFactory::create();
        $slimApp->setBasePath($sitePath);
        $this->route();
    }

    public function run(?ServerRequestInterface $request = null)
    {
        $this->slimApp->run($request);
    }

    public function handle(?ServerRequestInterface $request = null)
    {
        return $this->slimApp->handle($request);
    }

    public function route()
    {
        $route = $this->slimApp;
        $route->addMiddleware(new MetricsMiddleware());
        $route->addMiddleware(new DebugMiddleware(Application::getRenderer()->getResponseFactory()));
        $route->get('[/]', [HomeController::class, 'indexGet'])->addMiddleware(new LoginMiddleware());
        $route->group('', function (RouteCollectorProxy $route) {
            $route->get('/oauth2[/]', [OAuth2Controller::class, 'indexGet']);
            $route->get('/oauth2/callback[/]', [OAuth2Controller::class, 'callbackGet']);
            $route->get('/logout[/]', [OAuth2Controller::class, 'logoutGet']);
        });
    }
}
