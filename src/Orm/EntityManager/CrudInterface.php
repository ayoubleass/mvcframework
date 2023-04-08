<?php




namespace Src\Orm\EntityManager;



interface CrudInterface 
{

    public function getSchemaID() : string;


    public function getSchema() : string;


    public function getLastID() : int ;


    public function create(array $fields) : bool ;


    public function read(array $selectors =[], array $conditions = [] ,array $paramaters =[],
    array $optional = []) : array|object ;


    public function update(array $fields = [] , string $primary_key ) : bool ;


    public function delete(array $conditions = []) : bool;


    public function search(array $selectors =[], array $conditions = [],array $paramaters =[],
    array $optional = [] ) : array;


    public function rawQuery(string $rawQuery,array $conditions = []);


    public function setFetchMode($fetchMode) : self;

    
}