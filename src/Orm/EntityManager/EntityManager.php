<?php




namespace Src\Orm\EntityManager;

use Src\Orm\EntityManager\CrudInterface;




class EntityManager  implements EntityManagerInterface {


    private CrudInterface $crud;




    public function __construct(CrudInterface $curd){
        $this->crud = $curd;
    }




    public function getCrud() : CrudInterface {
        return $this->crud;
    }






}