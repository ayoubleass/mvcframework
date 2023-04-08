<?php



namespace Src\Orm\QueryBuilder;

use Exception;

class QueryBuilderFactory 
{



    public function __construct()
    {
        
    }


    public function create(string $QueryBuilderName){
        $queryBuilderObject = new $QueryBuilderName;
        if(!$queryBuilderObject instanceof QueryBuilderInterface ){
            throw new Exception();
        }
        return $queryBuilderObject;
    }



}