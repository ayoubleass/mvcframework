<?php



namespace App\Controllers;

use Src\Base\BaseController;
use Src\Validation\Validation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController  extends BaseController {



    public function __construct(protected Validation $v)
    {   
    }
    


    public function register(Request $request ,Response $response){
    }
      
       


    

    public function login(Request $request){
      
    }
           
       
    

    

}