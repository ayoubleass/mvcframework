<?php



namespace Src\Orm\DataConnection;


use PDO;
use PDOException;

class DataBaseConnection implements DataBaseConnectionInterface
{


    private \PDO $dbh;


    private array $credentials = [];



    public function __construct(array $credentials)
    {
        $this->credentials = $credentials;
    }
    


    public function open() : PDO {
        try{
            $this->dbh = new PDO($this->credentials['driver'] . 
                ':host=' . $this->credentials['host']
            .   ';dbname=' . $this->credentials['dbname'] ,
                $this->credentials['username'],
                $this->credentials['password'],
                [
                    //
                ]
            );
            return $this->dbh;
        }catch(PDOException $e){   
            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }




    public function close() : void{
        $this->dbh = null;
    }




}