<?php



namespace Src\Router;

use Src\Router\RouteTraits;
use Src\Router\Exception\RouterException;
use Src\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Router {


    use RouteTraits;
    
   
    protected array $routes = [];



    protected string  $prefix = '';




    protected string $middleware = '';


    
    protected  $action;


    protected  ?MiddlewareStack  $middlewareStack  = null;

    
    
    protected  array $params = [];

    

    
    protected array $paramName = [] ;




    protected Request $request;




    protected Container $container;



    protected Response $response;
    

    public function __construct(Request $request,Response $response,Container $container = null) 
    {
        $this->request = $request;
        $this->response = $response;
        $this->container = $container;
    }
    
    





    public function add(string $methods,string $path, mixed $action) : void {
        $path = (isset($this->prefix) && $this->prefix !== "")  ? 
        $this->prefix . $path : $path;
        foreach(explode('|',$methods) as $method){
                $this->routes []= [
                    'uri' => $path ?? '',
                    'method' => $method,
                    'action'  => $action,
                    'prefix' => $this->prefix,
                    'middleware' => [$this->middleware]
                ]; 
        }
    }
                    
        


  
    

    public function prefix(string $prefix, callable $groupes) : self {
        $parent_prefix =  $this->prefix;
        $this->prefix  = '/' . trim($prefix,'/');
        if(is_callable($groupes)){
            call_user_func($groupes,$this);
        } 
        $this->prefix = $parent_prefix;
        return $this;
    }






    public function only($key) : self {
        array_push($this->routes[array_key_last($this->routes)]['middleware'],$key) ;
        return $this;
    }





    public function middleware($middleware, callable $groupes) : self{
        $parent_middleware  =  $this->middleware;
        $this->middleware = $middleware ;
        if(is_callable($groupes)){
            call_user_func($groupes,$this);
        } 
        $this->middleware = $parent_middleware;
        return $this;
    }



   


    public function match() : bool {
        foreach($this->routes as $route){
            if($route['middleware'][0] === 'App\Middleware\TrilingSlashMiddleware'){
               $this->setMiddleware(['App\Middleware\TrilingSlashMiddleware'])->process();
               unset($route['middleware'][0]);
            }
            $path = '#^' . preg_replace('/\/{(.*?)}/','/(.*?)',$route['uri']). '$#';
            preg_match($path,$this->request->getPathInfo(),$matches);
            if(!empty($matches) && $route['method'] === $this->request->getMethod()){
                unset($matches[0]);
                $this->setMiddleware($route['middleware']);
                $this->getParamesName($route['uri']);
                $this->params = array_combine(array_values($this->paramName),$matches);
                $this->action = $route['action'];
                return true;
            }
            if($route['method'] !== $this->request->getMethod()){
                throw new RouterException(sprintf('%s is not allowed' ,$this->request->getMethod()));
            }
        }
        return false;
    }
              
               
                
                
            
    public function handle(?SessionInterface $session = null){
        if($this->match() && !empty($this->action)){
                if($this->middlewareStack !== null ){
                    $this->middlewareStack->process();
                }
                if(is_callable($this->action)){
                    return call_user_func($this->action,$this->params);
                }
                if(is_array($this->action)){
                    list($controller,$method) = $this->action;
                    if(class_exists($controller)){
                        if(!isset($this->container)){
                            $controller = new $controller;
                        }else{
                            $controller = $this->container->get($controller);
                        }
                        if(method_exists($controller,$method)){
                            return  call_user_func_array([$controller,$method],[$this->request,$this->response,$this->params,$session]);
                        }
                        //Error must be thrown 
                    }
                    //Error must be thrown 
                }
        }
        throw new RouterException('404 : page not found');
    }
                            
        



    public function getParamesName($route) : array {
        foreach(explode('/',$route) as $value){
            if(!str_contains($value,'{') || !isset($value)){
                continue;
            }
            $this->paramName []= trim($value,'{}');
        }
        array_filter($this->paramName);
        return $this->paramName ;
    }






    public function getRoutes() : array {
        return $this->routes;
    }


    


    public function setMiddleware(array $middlewares){ 
        foreach($middlewares as $middleware ){
            $path = ROOT_DIR . '/app/Middleware';
            $nameSpace = 'App\Middleware\\';
            foreach(glob($path .'/*.php') as $file){
                $midllewareClassName  = $nameSpace . pathinfo($file,PATHINFO_FILENAME);
                if($midllewareClassName === $middleware){
                    $this->middlewareStack =  new MiddlewareStack($this->container->get($middleware),$this->request);
                }
            }
        }
        return $this->middlewareStack;
    }







}


    

    