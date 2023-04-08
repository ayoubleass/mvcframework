<?php




namespace Src\Orm\EntityManager;

use Throwable;
use Src\Orm\DataMapper\DataMapperInterface;
use Src\Orm\EntityManager\CrudInterface;
use Src\Orm\QueryBuilder\QueryBuilderInterface;

class Crud implements CrudInterface
{



    private string $tableSchema;


    private string  $tableSchemaID;



    private QueryBuilderInterface $queryBuilder;



    private DataMapperInterface $dataMapper;




    public function __construct(string $schema,string $schemaID,DataMapperInterface $dataMapper,
    QueryBuilderInterface $queryBuilder)
    {
        $this->tableSchema = $schema;
        $this->tableSchemaID =$schemaID;
        $this->dataMapper = $dataMapper;
        $this->queryBuilder = $queryBuilder;
    }

    
    
    public function getSchemaID() : string{
        return $this->tableSchemaID;
    }



    public function getSchema() : string {
        return (string) $this->tableSchema;
    }

    
    

    public function getLastID() : int {
        return (int) $this->dataMapper->getLastID();
    }




    
    public function create(array $fields) : bool  {
        try{
            $args= [
                'fields'        => $fields,
                'table'         => $this->getSchema(),
                'type'          => 'insert',
                'primary_key'   => $this->getSchemaID()
            ];
            $sql = $this->queryBuilder->buildQuery($args)->insertQuery();
            $this->dataMapper->presist($sql,$fields);
            if($this->dataMapper->numRows() === 1){
                return true; 
            }
        }catch(Throwable $throwable){
            throw $throwable;
        }
    }





    public function read(array $selectors =[], array $conditions = [] ,array $paramaters =[],
    array $optional = []) : array|object {
        try{
            $args= [
                'selectors'        => $selectors,
                'conditions'       => $conditions,
                'parameters'       => $paramaters,
                'extras'           => $optional, 
                'table'            => $this->getSchema(),
                'type'             => 'select',
                'primary_key'      => $this->getSchemaID()
            ];
            $sql = $this->queryBuilder->buildQuery($args)->selectQuery();
            $this->dataMapper->presist($sql,$this->dataMapper->buildQUeryParams($conditions,$paramaters));
            if($this->dataMapper->numRows() > 0){
                return $this->dataMapper->results();
            }
        }catch(Throwable $throwable){
            throw $throwable;
        }
    }



    
    public function update(array $fields = [] , string $primary_key  = 'id') : bool  {
        try{
                $args= [
                'fields'        => $fields,
                'table'         => $this->getSchema(),
                'type'          => 'update',
                'primary_key'   => $primary_key
                ];
            $sql = $this->queryBuilder->buildQuery($args)->updateQuery();
            $this->dataMapper->presist($sql,$fields);
            if($this->dataMapper->numRows() === 1){
                return true; 
            }
        }catch(Throwable $throwable){
            throw $throwable;
        }

    }



    
    public function delete(array $conditions = []) : bool {
        try{
                $args= [
                'conditions'        => $conditions,
                'table'             => $this->getSchema(),
                'type'              => 'delete',
                ];
            $sql = $this->queryBuilder->buildQuery($args)->deleteQuery();
            $this->dataMapper->presist($sql,$this->dataMapper->bindParameters($conditions));
            if($this->dataMapper->numRows() === 1){
                return true; 
            }
        }catch(Throwable $throwable){
            throw $throwable;
        }
    }


    
    public function search(array $selectors =[], array $conditions = [],array $paramaters =[],
    array $optional = [] ) : array {

        try{
            $args= [
                'selectors'        => $selectors,
                'conditions'       => $conditions,
                'table'            => $this->getSchema(),
                'type'             => 'search',
                'primary_key'      => $this->getSchemaID()
            ];
            $sql = $this->queryBuilder->buildQuery($args)->searchQuery();
            $this->dataMapper->presist($sql,$this->dataMapper->buildQUeryParams($conditions));
            if($this->dataMapper->numRows() > 0){
                return $this->dataMapper->results();
            }
        }catch(Throwable $throwable){
            throw $throwable;
        }
    }


    
    
    public function rawQuery(string $rawQuery,array $conditions = []){
        try{
            $args= [
            'conditions'        => $conditions,
            'raw'               => $rawQuery,
            'table'             => $this->getSchema(),
            'type'              => 'raw',
            ];
        $sql = $this->queryBuilder->buildQuery($args)->rawQuery();
        $this->dataMapper->presist($sql,$this->dataMapper->bindParameters($conditions));
        if($this->dataMapper->numRows() === 1){
            
        }
    }catch(Throwable $throwable){
        throw $throwable;
    }
    }



    public function setFetchMode($fetchMode) : self {
        $this->dataMapper->setFetchMode($fetchMode);
        return $this;
    }


    
}