<?php


namespace Src\Orm;

use Src\Orm\DataConnection\DataBaseConnection;
use Src\Orm\DataMapper\DataMapperFactory;
use Src\Orm\EntityManager\Crud;
use Src\Orm\EntityManager\EntityManager;
use Src\Orm\EntityManager\EntityManagerInterface;
use Src\Orm\QueryBuilder\QueryBuilder;
use Src\Orm\QueryBuilder\QueryBuilderFactory;

class OrmManager{
    
    
    
    private string $schema; 
    
    
    
    private string $schemaID;
    
    
    
    public function __construct(string $schema ,string $schemaID)
    {
        $this->schema = $schema;
        $this->schemaID = $schemaID;
    }



    
    public function initiliaze() : EntityManagerInterface {
        // hardcored databas crdentials
        $dataMapperFactory = new DataMapperFactory([
            'driver' => 'mysql',
            'host'   => 'localhost',
            'dbname' => 'livraison', 
            'username' => 'ayoub',
            'password' => '123456789' 
        ]);
        $dataMapper  = $dataMapperFactory->create(DataBaseConnection::class);
        $queryBuilderFacorty = new QueryBuilderFactory();
        $queryBuilder = $queryBuilderFacorty->create(QueryBuilder::class);
        $crud = new Crud($this->schema,$this->schemaID,$dataMapper,$queryBuilder);
        $entityManager = new EntityManager($crud);
        return $entityManager;
    }





}