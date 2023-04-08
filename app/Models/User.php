<?php


namespace App\Models;
use Src\Base\BaseModel;




class User extends BaseModel {


    protected const TABLE_SCHEMA = 'users';

    protected const TABLE_SCHEMAID = 'id';


    public function __construct(){
       parent::__construct(self::TABLE_SCHEMA,self::TABLE_SCHEMAID); 
    }

}