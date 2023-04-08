<?php



namespace App\Middleware;
use Symfony\Component\HttpFoundation\Request;



class TrilingSlashMiddleware{


    public function handle(Request $request, $response = null){
        $uri  = $request->getPathInfo();
        if(strlen($uri) > 1 &&  $uri[-1] === '/'){
                $uri = substr($uri,0,-1);
                header('Location:'.$uri);
                exit;
        } 
        
    }
        

        
}

