<?php



namespace Src\Orm\DataRepository;

use Symfony\Component\HttpFoundation\Request;


interface DataRepositoryInterface 
{

    public function find(int $îd) : array ;

    public function findAll() : array;


    public function findBy(array $selectors =[], array $conditions = [] ,array $paramaters =[],
    array $optional = []);


    public function findOneBy(array $conditions) : array ;


    public function findObjectBy( array $conditions = [] ,array $selectors =[]) : object ;


    public function finfBySearch(array $selectors =[], array $conditions = [] ,array $paramaters =[],
    array $optional = []) : array ;


    public function findIDAndDelete(array $conditions = []) : bool;


    public function findIDAndUpdate(array $fields = [],int $id) : bool ;


    public function findWithSearchAndPaging(array $conditions ,Request $request);


    
}