<?php



namespace Src\Session\Storage;


interface SessionStorageInterface 
{

    
    public function setSessionName(string $sessionName);


    
    public function getSessionName() : string;

    
    
    public function setSessionID(string $sessionID) : void;


    
    public function getSessionID();


    
    public function setSession(string $key,mixed $value) : void;


    
    public function getSession(string $key,$default = null) : mixed;

    
    
    public function invalidate() : void;


    
    public function deleteSession(string $key) :bool ;
    

    
    public function hasSession(string $key) : bool;
    

    
    public function flush(string $key,mixed $default =null ) : mixed ;



}