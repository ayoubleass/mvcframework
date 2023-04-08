<?php




namespace Src\Session;
use Throwable;
use Src\Session\SessionInterface;
use Src\Session\Exception\SessionException;
use Src\Session\Storage\SessionStorageInterface;

class Session  implements SessionInterface
{


    private SessionStorageInterface $storage;
    

    
    private string $sessionName;



    protected const SESSION_PATT  = '/^[a-zA-Z0-9_\.]{1,64}$/';



    public function __construct(string $sessionName,SessionStorageInterface $storage)
    {   
        if(!preg_match(self::SESSION_PATT,$sessionName)){
            throw new SessionException('Session name must be valid');
        }
        $this->sessionName = $sessionName;
        $this->storage = $storage;
    }





    public function set($key, $value) : void {
        try{
            $this->storage->setSession($key, $value);
        }catch(Throwable){
            throw new SessionException('AN Exception was thrown trying to seting a session');
        }
    }

    

    

    public function get(string $key,$default = null){
        try{
            return $this->storage->getSession($key,$default);
        }catch(Throwable){
            throw new SessionException('AN Exception was thrown trying to getting the session
            by key');
        }
    }



    public function delete(string $key) : bool {
        try{
            return $this->storage->deleteSession($key);
        }catch(Throwable){
            throw new SessionException('AN Exception was thrown trying to deleting the session
            by key');
        }
    }



    public function invalidate() : void {
        $this->storage->invalidate();
    }




    public function flush(string $key,mixed $value){
        try{
            return $this->storage->flush($key,$value);
        }catch(Throwable){
            throw new SessionException('AN Exception was thrown trying to deleting the session
            by key');
        }
    }



    public function has(string $key) : bool {
        return $this->storage->hasSession($key);
    } 





    


}