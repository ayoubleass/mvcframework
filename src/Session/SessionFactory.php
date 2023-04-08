<?php



namespace Src\Session;

use Src\Session\Storage\SessionStorageInterface;
use Src\Session\Exception\SessionStorageInvalidArgumentException;


class SessionFactory 
{
    
    public function __construct()
    {}



    public function create(string $sessionName , string $storageName, array $options = []) : SessionInterface {
        $storageObject = new $storageName($options);
        if(!$storageObject instanceof SessionStorageInterface){
            throw new SessionStorageInvalidArgumentException(sprintf('%s is not a valid session storage object',
            $storageObject));
        }
        return new Session($sessionName,$storageObject);
    }   

}