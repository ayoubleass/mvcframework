<?php


namespace Src\Orm\QueryBuilder;

use Exception;

class QueryBuilder  implements QueryBuilderInterface
{



    private const SQL_DEFAULT = 
    [
        'selectors' =>  [],
        'conditions' => [],
        'fields' => [],
        'order_by' => [],
        'primary_key' => '',
        'table' => '',
        'type' => '',
        'extras' => [],
        'raw' => ''
    ];



    
    
    
    private const QUERY_TYPE =
    [
        'select',
        'insert',
        'update',
        'delete',
        'search'
    ];



    private $sqlString = '';





    private array $args = [];






    public function __construct() {}






    public function buildQuery($args = [])  : self {
        if(empty($params) && count($args) < 0){
            throw new Exception('Query is not valid');
        }
        $this->args = array_merge(self::SQL_DEFAULT,$args);
        return $this;
    }




    public function insertQuery() : string {
        if($this->isQueryTypeValid($this->args['type']) && is_array($this->args['fields'])){
            $index =  array_map(fn($key)=> ':' .$key ,array_keys($this->args['fields']));
            $placeholders = implode(', ',$index) ;
            $this->sqlString = 'INSERT INTO ' . $this->args['table'] .  ' VALUES(' .
            $placeholders .  ');' ;
        }
        return $this->sqlString; 
    }




    
    public function selectQuery() : string {
        if($this->isQueryTypeValid($this->args['type'])){
            $selectors = (!empty($this->args['selectors'])) ?  implode(',', $this->args['selectors']) : '*';
            $this->sqlString = "SELECT $selectors FROM {$this->args['table']} ";  
            if(count($this->args['conditions']) > 0){
                $this->sqlString .= 'WHERE ';   
                $conditions = array_map(function($k){
                    return $k . ' = :'. $k ;
                }, array_keys($this->args['conditions'])); 
                $this->sqlString .= implode(' AND ', $conditions);
            }
            if(!empty($this->args['order_by'])){
                $this->sqlString .= 'ORDER BY ' . implode(',',$this->args['order_by']) . ' ';
            }
            return $this->sqlString  . ';';
        }
    }



    
    public function updateQuery() : string {
        if($this->isQueryTypeValid($this->args['type'])){
            $fields = array_map(function($k){
                return $k . ' = :'. $k ;
            }, array_keys($this->args['fields'])); 
            $this->sqlString = "UPDATE {$this->args['table']} SET " . implode(', ', $fields);  
            $this->sqlString .= ' WHERE ';   
            if(isset($this->args['primary_key'])){
                $this->sqlString .= $this->args['primary_key'] . '= :' 
                . $this->args['primary_key'] . ' LIMIT 1';
            }
            return $this->sqlString  . ';';
        }
    }
              




    public function deleteQuery() : string {
        if($this->isQueryTypeValid($this->args['type'])){
            $index = array_keys($this->args['conditions']);
            $this->sqlString = "DELETE  FROM {$this->args['table']} WHERE {$index[0]} = :{$index[0]}
            LIMIT 1 ";  
            return $this->sqlString  . ';';
        }
    }
            
    

    public function orderBy(){

    }


    


    public function searchQuery(){

    }



    public function rawQuery(){

    }




    public function isQueryTypeValid(string $type){
        if(in_array($type,self::QUERY_TYPE)){
            return true;
        }
        return false;
    }




}

