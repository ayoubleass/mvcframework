<?php



namespace Src\Orm\DataMapper;

interface DataMapperInterface 
{
    

    public function prepare($sql) : self ;


    public function bindParameters(array $params, bool $isSearch = false) : self;

    
    public function execute() : bool;


    public function getLastId() : string|false ;


    public function presist($sql,$params) : mixed ;


    public function buildQUeryParams(array $conditions,array $params = []);


    public function results() : mixed ;


    public function numRows() : int ;


    public function setfetchMode($fetchMOde) : self ;


    public function getDbh();
}