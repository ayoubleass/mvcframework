<?php

namespace Src\Orm\DataRepository;

use Exception;
use Src\Orm\OrmManager;

class DataRepositoryFactory 
{

    private string $tableSchema;


    private string $schemaId;


    
    public function __construct(string $tableSchema,string $schemaID)
    {
        $this->tableSchema = $tableSchema;
        $this->schemaId    = $schemaID;    
    }



    public function create(string $dataRepositoryName){
        $ormFactory = new OrmManager($this->tableSchema, $this->schemaId);
        $entityManger = $ormFactory->initiliaze();
        $dataRepositoryObject = new $dataRepositoryName($entityManger);
        if(!$dataRepositoryObject instanceof DataRepositoryInterface ){
            throw new Exception($dataRepositoryName . ' is not a valid');
        }
        return $dataRepositoryObject;
    }

    
}