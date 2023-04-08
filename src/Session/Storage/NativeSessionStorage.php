<?php



namespace Src\Session\Storage;

use Src\Session\Storage\AbstractSessionStorage;




class NativeSessionStorage extends AbstractSessionStorage
{

    
    
    public function __construct(array $options = [])
    {
        parent::__construct($options);
    }



    public function getSession(string $key, $default = null): mixed
    {
        if($this->hasSession($key)){
            return $_SESSION[$key];  
        }
        return $default;
    }

        


    public function setSession(string $key, mixed $value): void
    {
        if(!is_array($value)){
            $_SESSION[$key] = $value;
        }else{
            $_SESSION[$key][] = $value;
        }

    }



    public  function hasSession(string $key): bool
    {
        return isset($_SESSION[$key]);
    }
        

    

    public function invalidate() : void {
        $_SESSION = [];
        if(ini_set('session.use_cookies','')){
            $params = session_get_cookie_params();
            setcookie($this->getSessionName(),'', 
            time() - $params['lifetime'],
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly']
            );
        }
        session_unset();
        session_destroy();
    }



    public function deleteSession(string $key) :bool {
        if($_SESSION[$key]){
            unset($_SESSION[$key]);
            return true;
        }
        return false;
    }
    

    
    

    public function flush(string $key,mixed $default =null ) : mixed {
        $value =$_SESSION[$key];
        $this->deleteSession($key);
        return $value;
    }



}