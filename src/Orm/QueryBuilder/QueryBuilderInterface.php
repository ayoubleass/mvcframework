<?php


namespace Src\Orm\QueryBuilder;



interface QueryBuilderInterface 
{


    public function buildQuery($args = [])  : self ;

    
    public function insertQuery() : string;


    public function selectQuery() : string ;


    public function updateQuery() : string ;

    
    public function deleteQuery() : string;

    
    
    public function searchQuery();

    
    
    public function rawQuery();

}

