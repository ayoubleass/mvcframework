<?php

namespace Src\Orm\DataConnection;


interface DataBaseConnectionInterface
{


    public function open() : \PDO ;


    public function close() : void;

    
}