<?php declare(strict_types=1);

use App\Models\GifApiClient;
use App\Models\Gif;
use App\Controllers\GifsController;
use App\View;

require_once 'vendor/autoload.php';
require 'app/Views/index.view.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$loader = new \Twig\Loader\FilesystemLoader('app/Views');
$twig = new \Twig\Environment($loader);

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('POST', '/search', 'App\Controllers\GifsController@getSearchedGifs');
    $r->addRoute('GET', '/trending', 'App\Controllers\GifsController@getTrendingGifs');
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        [$controllerName, $methodName] = explode('@', $handler);
        $controller = new $controllerName;
        /** @var View $response */
        $response = $controller->{$methodName}();
        echo $twig->render($response->getTemplate() . '.view.twig', $response->getGifsList());
        break;
}