<?php



namespace Src\Application;

use Throwable;
use Src\Router\Router;
use Src\Router\Container;
use Src\Traits\SystemTrait;
use Src\Session\SessionInterface;
use Src\GlobalManager\GlobalManager;
use Symfony\Component\HttpFoundation\Response;

class Application {

    use SystemTrait;


    protected Router $router;
    
    
    protected string $rootDir;


    protected  Response  $response;


    protected Container $container;


    protected  SessionInterface $session;




    public function __construct(string $root, Router $router, Response $response,Container $container) {
        
        $this->router = $router;
        $this->rootDir =  $root;
        $this->response = $response;
        $this->container = $container;
        $this->session = $this->setSession();
    }




    public function run(){
        try{
           echo $this->router->handle($this->session);
            return $this;
        }catch(Throwable $e){
            throw $e;
        }

    }




    public function router() : Router {
        return $this->router;
    }




    public function setSession() : SessionInterface {
        Application::sessionInit(true,[
            'gc_maxlifetime' => '',
            "gc_divisor" => '',
            "gc_probability" => '',
            "cookie_lifetime"=> '',
            "use_cookies" => '',
            "session_name" => 'session',
            "lifetime" => 1,
            "path" => '',
            "httponly"=> ''
        ]);
        return GlobalManager::get(('global_session'));
    }
        



    
}