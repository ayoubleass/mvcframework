<?php




namespace Src\Base;
use Src\Twig\Twig;
use Symfony\Component\HttpFoundation\Session\Session;

class BaseController 
{

    
    public function __construct()
    {}


    
    public function render(string $path , array $params =[]){
        return self::twig()->render($path,$params);
    }


    
    
    private static function twig(){
        return (new Twig)->init();
    }


    
   

    
    
 }