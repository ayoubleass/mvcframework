<?php



namespace Src\GlobalManager;




interface GlobalManagerInterface
{


    public static function set(string $key, mixed $value) : void;


    public static function get(string $key);


    
}