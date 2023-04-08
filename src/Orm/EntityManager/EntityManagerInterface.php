<?php





namespace Src\Orm\EntityManager;

use Src\Orm\EntityManager\CrudInterface;



interface EntityManagerInterface 
{

    public function getCrud() : CrudInterface;

}