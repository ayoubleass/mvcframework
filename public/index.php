<?php

use App\Controllers\Admin\DashboardController;
use App\Controllers\AuthController;
use App\Middleware\TrilingSlashMiddleware;
use Src\Application\Application;
use Src\Router\Container;
use Src\Router\Router;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require __DIR__ . '/../vendor/autoload.php';


define('ROOT_DIR', dirname(__DIR__));




$request   = Request::createFromGlobals();
$response  = new Response();
$container = new Container();


$router = new Router($request,$response,$container);
$app    = new Application(ROOT_DIR, $router,$response,$container);




$app->router()->prefix('/v1',function($router){
    $router->post('/api/register',[AuthController::class,'register']);
});





/* 
$app->router()->prefix('/admin',function($router){
    $router->middleware(TrilingSlashMiddleware::class, function($router){
        $router->get('/dashboard',[DashboardController::class,'index']);
    }); 
});
 */






$app->run();  
















