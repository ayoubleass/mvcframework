<?php


namespace Src\Orm\DataMapper;

use Exception;
use Src\Orm\DataConnection\DataBaseConnectionInterface;

class DataMapperFactory {

    
    private array $credentials;


    public function __construct(array $credentials)
    {
        $this->credentials  = $credentials; 
    }



    public function create(string $dataBaseConnectionName) 
    : DataMapperInterface {

        $dataBaseConnectionObject = new $dataBaseConnectionName($this->credentials);
        if(!$dataBaseConnectionObject instanceof DataBaseConnectionInterface){
            throw new Exception('Something is wrong ' . __CLASS__);
        }
        return new DataMapper($dataBaseConnectionObject);
    }
        

}