<?php



namespace Src\Orm\DataRepository;

use PDO;
use Throwable;
use Symfony\Component\HttpFoundation\Request;
use Src\Orm\DataRepository\DataRepositoryInterface;
use Src\Orm\EntityManager\EntityManagerInterface;

class DataRepository  implements DataRepositoryInterface
{


    private EntityManagerInterface $em;



    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }



    public function find(int $id) : array {
        try{
            return $this->findOneBy([$this->em->getCrud()->getSchemaID() => $id]);
        }catch(Throwable $throwable){
            throw new $throwable;
        }
    }



    public function findAll() : array {
        try{
            return $this->em->getCrud()->read();
        }catch(Throwable $throwable ){
            throw new $throwable;
        }
    }




    public function findBy(array $selectors =[], array $conditions = [] ,array $paramaters =[],
    array $optional = []){
        try{
            return $this->em->getCrud()->read($selectors,$conditions,$paramaters,$optional);
        }catch(Throwable $throwable ){
            throw new $throwable;
        }
    }




    public function findOneBy(array $conditions) : array {
        try{
            return $this->em->getCrud()->read([],$conditions);
        }catch(Throwable $throwable ){
            throw new $throwable;
        }
    }





    public function findObjectBy( array $conditions = [] ,array $selectors =[]) : object {
        try{
            return $this->em->getCrud()->setFetchMode(PDO::FETCH_OBJ)->read($selectors,$conditions);
        }catch(Throwable $throwable ){
            throw new $throwable;
        }
    }
    




    public function finfBySearch(array $selectors =[], array $conditions = [] ,array $paramaters =[],
    array $optional = []) : array {
        try{
            return $this->em->getCrud()->search($selectors,$conditions,$paramaters,$optional);
        }catch(Throwable $throwable ){
            throw new $throwable;
        }
    }






    public function findIDAndDelete(array $conditions = []) : bool {
        try{
            $results = $this->findOneBy($conditions);
            if($results !== null && count($results)> 0){
                $delete = $this->em->getCrud()->delete($conditions);
                if($delete){
                    return true;
                }
            } 
        }catch(Throwable $throwable ){
            throw new $throwable;
        }
    }






    public function findIDAndUpdate(array $fields = [],int $id) : bool {
        try{
            $results = $this->findOneBy([$this->em->getCrud()->getSchemaID() => $id]);
            if($results !== null && count($results)> 0){
                $params = (!empty($fields)) ? array_merge([$this->em->getCrud()->getSchemaID()=>$id],$fields) 
                : $fields; 
                $update = $this->em->getCrud()->update($fields,$id);
                if($update){
                    return true;
                }
            } 
        }catch(Throwable $throwable ){
            throw new $throwable;
        }
    }



    

    public function findWithSearchAndPaging(array $conditions ,Request $request){}


    
    
}