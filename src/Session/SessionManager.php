<?php



namespace Src\Session;

use Src\Session\Storage\NativeSessionStorage;


class SessionManager 
{


    public static function initialize(array $otions = []) : SessionInterface {
        $factory = new SessionFactory();
        return $factory->create('default',NativeSessionStorage::class,$otions);
    }



}