<?php


namespace Src\Base;

use Src\Orm\DataRepository\DataRepository;
use Src\Orm\DataRepository\DataRepositoryFactory;
use Src\Orm\DataRepository\DataRepositoryInterface;

class BaseModel 
{

    protected $tableSchema ;

    
    protected $tableSchemaID;


    
    public function __construct($tableSchema ,$tableSchemaID){
        $this->tableSchema = $tableSchema;
        $this->tableSchemaID = $tableSchemaID; 
    }


    
    public  function getRepo() : DataRepositoryInterface {
        $dataRepositoryFactory = (new DataRepositoryFactory($this->tableSchema,$this->tableSchemaID));
        return $dataRepositoryFactory->create(DataRepository::class);
    }


}